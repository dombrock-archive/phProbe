<?php 
//PHProbe
// A very simple utility for discovering directories and files or checking their status codes
class phprobe
{
	public $verb;
	public $export;
	public $exportList;
	public function Probe($opt){
		$this->Vecho("Running with verbose output \n");
		$LIST = file_get_contents($opt["list"]);
		$LISTA = explode("\n", $LIST);
		$i = 1;
		foreach ($LISTA as $item){
			$OUT = shell_exec($opt['cmd'].' '.$opt['base'].$item);
			$this->Vecho("\n");
			$this->Vecho($i."/".count($LISTA)."\n");
			if($OUT == "200"){
				//add to list
				$this->Vlog($opt['base'].$item."\n");
			}
			$this->Vecho($opt['base'].$item."\n");
			$this->Vecho($OUT."\n");
			$i = $i +1;
		}
	}
	public function Export($opt){
		$this->exportList = implode("", $this->exportList);
		$loc = "Output/".$opt["base"]."-".$opt["list"];
		file_put_contents($loc, $this->exportList);
		$this->Vecho("\n///-EXPORT-LIST-///\n");
		$this->Vecho("( ".$loc." ) \n");
		echo $this->exportList;
	}
	public function Vecho($string){
		if($this->verb == true){
			echo $string;
		}
	}
	public function Vlog($string){
		if($this->export == true){
			$this->exportList[] = $string;
		}
	}
	public function initProbe($opt){
		if($opt["verbose"]==true){
			$this->verb = true;
		}
		if($opt["export"]==true){
			$this->export = true;
		}
		$this->Probe($opt);
		if($this->export==true){
			$this->Export($opt);
		}
	}
}
