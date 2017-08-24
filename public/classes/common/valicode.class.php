<?php
/*
** Image Verification Class
*/
class valicode{
	private $im;//Image resources
	private $width;//Image Width
	private $height;//Image Height
	private $bgcolor;//Background color
	private $point_num;//Point in the image painted on the number of
	private $point_color;//Interference color of the pixel
	private $line_num;//Drawing lines in the image on the number of articles
	private $line_color;//Interference line color
	private $font_num;//Verify the number of characters
	public $ext_num_type=''; //默认是大小写数字混合型，1 2 3 分别表示 小写、大写、数字型 
	private $len=4;//验证码长度
	private $grline=2; //干扰线
	//背景色的红绿蓝，默认是浅灰色 
	public $red=238; 
	public $green=238; 
	public $blue=238; 
 
	function __construct($len=4,$im_width='',$im_height=25){
		$this->len =$len; 
		$im_width = $len * 15; 
		$this->width = $im_width; 
		$this->height= $im_height; 
		$this->im = imagecreate($im_width,$im_height); 
	}
	// 设置图片背景颜色，默认是浅灰色背景 
	function set_bgcolor () { 
		imagecolorallocate($this->im,$this->red,$this->green,$this->blue); 
	} 
	//Set image size
	function set_size(){
		if(empty($this->font_num)){
			$this->font_num=4;
		}
		$this->width=$this->font_num*12+4;// According to the image width in characters
		$this->height=20;
	}
	
	//Create an image
	function create_pic(){
		$this->im=imagecreate($this->width,$this->height);
		$this->set_bgcolor();
		//imagecolorallocate($this->im,200,200,200);
	}
	
	//Set interference point
	function set_point(){
		if(empty($this->point_num)){
			$this->point_num=50;
		}
		for($i=0;$i<$this->point_num;$i++){
			$this->point_color=imagecolorallocate($this->im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));//Interference generated pixel color
			imagesetpixel($this->im,$this->width,$this->height,$this->point_color);//Interference generated pixels
		}
	}
		
	//Interference lines set
	function set_line(){
		if(empty($this->line_num)){
			$this->line_num=$this->grline;
		}
		for($i=0;$i<$this->line_num;$i++){
			$this->line_color=imagecolorallocate($this->im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));//Generate interference line color
			imageline($this->im,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$this->line_color);
		}
	}
	
	//Generate random characters, and MD5 encryption
	function ver_str(){
		$string=strtoupper(md5(mt_rand(0,9)));//MD5 encryption with randomly generated numbers
		if(empty($this->font_num)){
			$this->font_num=4;
		}
		return substr($string,0,$this->font_num);
	}
	
	// 获得任意位数的随机码 
	function get_randnum () { 
		$rnum="";
		$str="";
		$an1 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
		$an2 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
		$an3 = '0123456789'; 
		if ($this->ext_num_type == '') $str = $an1.$an2.$an3; 
		if ($this->ext_num_type == 1) $str = $an1; 
		if ($this->ext_num_type == 2) $str = $an2; 
		if ($this->ext_num_type == 3) $str = $an3; 
		for ($i = 0; $i < $this->len; $i++) { 
			$start = rand(1,strlen($str) - 1); 
			$rnum .= substr($str,$start,1); 
		} 
		return $rnum; 
	} 
 
	
	//Written verification characters
	function show(){
		$this->set_size();//Set the image size
		$this->create_pic();//Create an image
		$string=$this->get_randnum();//Get character at any time

		for($i=0;$i<$this->font_num;$i++){
			$font_color=imagecolorallocate($this->im,mt_rand(100,150),mt_rand(100,150),mt_rand(100,150));
			imagestring($this->im,5,$i*10+8,mt_rand(1,7),$string[$i],$font_color);
		}
		$this->set_point();//Drawing interference point
		$this->set_line();//Interference lines drawn
    	//header("Contetn-type:image/png");
		imagepng($this->im);//Output image
		imagedestroy($this->im);//Free memory
		return $string;
	}		
}

?>