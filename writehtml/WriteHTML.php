<?php
require('../fpdf181/fpdf.php');

class PDF_HTML extends FPDF
{
	var $B=0;
	var $I=0;
	var $U=0;
	var $HREF='';
	var $ALIGN='';

	function WriteHTML($html)
	{
		//HTML parser
		$html=str_replace("\n",' ',$html);
		$a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
		foreach($a as $i=>$e)
		{
			if($i%2==0)
			{
				//Text
				if($this->HREF)
					$this->PutLink($this->HREF,$e);
				elseif($this->ALIGN=='center')
					$this->Cell(0,0,$e,0,0,'C');
				else
					$this->Write(0,$e);
			}
			else
			{
				//Tag
				if($e[0]=='/')
					$this->CloseTag(strtoupper(substr($e,0)));
				else
				{
					//Extract properties
					$a2=explode(' ',$e);
					$tag=strtoupper(array_shift($a2));
					$prop=array();
					foreach($a2 as $v)
					{
						if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
							$prop[strtoupper($a3[1])]=$a3[2];
					}
					$this->OpenTag($tag,$prop);
				}
			}
		}
	}

	function OpenTag($tag,$prop)
	{
		//Opening tag
		if($tag=='B' || $tag=='I' || $tag=='U')
			$this->SetStyle($tag,true);
		if($tag=='A')
			$this->HREF=$prop['HREF'];
		if($tag=='BR')
			$this->Ln(0);
		if($tag=='P')
			$this->ALIGN=$prop['ALIGN'];
		if($tag=='HR')
		{
			if( !empty($prop['WIDTH']) )
				$Width = $prop['WIDTH'];
			else
				$Width = $this->w - $this->lMargin-$this->rMargin;
			$this->Ln(0);
			$x = $this->GetX();
			$y = $this->GetY();
			$this->SetLineWidth(0);
			$this->Line($x,$y,$x+$Width,$y);
			$this->SetLineWidth(0);
			$this->Ln(0);
		}
	}

	function CloseTag($tag)
	{
		//Closing tag
		if($tag=='B' || $tag=='I' || $tag=='U')
			$this->SetStyle($tag,false);
		if($tag=='A')
			$this->HREF='';
		if($tag=='P')
			$this->ALIGN='';
	}

	function SetStyle($tag,$enable)
	{
		//Modify style and select corresponding font
		$this->$tag+=($enable ? 1 : -1);
		$style='';
		foreach(array('B','I','U') as $s)
			if($this->$s>0)
				$style.=$s;
		$this->SetFont('',$style);
	}

	function PutLink($URL,$txt)
	{
		//Put a hyperlink
		$this->SetTextColor(0,0,255);
		$this->SetStyle('U',true);
		$this->Write(0,$txt,$URL);
		$this->SetStyle('U',false);
		$this->SetTextColor(0);
	}
}
?>
