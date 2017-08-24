<?PHP
	/*
	*Upload Common Class Library
	*/
	class upfilenew{
	
		private $file_size;//Upload source file size
		private $file_tem;//Upload file temporary storage name
		private $file_name;//Upload file name
		private $file_type;//Upload File Type
		private $file_max_size=2000000;//The maximum allowed file upload
		private $file_folder="userfiles";//Upload file path
		private $file_subfolder="image";//Upload file sub path
		private $over_write=true;//Whether to overwrite files the same name
		private $ismanager=false;//是否后台 --更新20160315
		private $allow_type=array('image/jpg','image/jpeg','image/png','image/pjpeg','image/gif','image/bmp','image/x-png','application/vnd.ms-excel','application/zip','application/octet-stream','application/x-rar-compressed','application/x-shockwave-flash');//Types allowed to upload pictures
	
	    function __set($file_subfolder,$value){
			$this->$file_subfolder=$value;
	    }
	    function __get($file_subfolder){
		   return $this->$file_subfolder;
		}
 		
		//Constructor
		function __construct($file){
			
			$this->file_name=$_FILES[$file]['name'];//Clients of the original file name
			$this->file_type=$_FILES[$file]['type'];//File Type
			$this->file_tem=$_FILES[$file]['tmp_name'];//The temporary storage file name, usually the system默认
			$this->file_size=$_FILES[$file]['size'];//File Size
		}
		
		//If the folder does not exist, create a folder 
		function creatFolder($f_path){
			if(!file_exists($f_path)){
				mkdir($f_path,0777);
			}
		}
		
		//Determine if a file upload limit is not exceeded
		function is_big(){
			if($this->file_size>$this->file_max_size){
				echo "上传照片超过限制，请将图片处理后重传！";
				exit;
			}
		}
		
		//Check the file type
		function check_type(){
			if(!in_array($this->file_type,$this->allow_type)){		
				echo "Upload file type is not correct";
				exit;
			}
		}
		
		//Check if file exists
		function check_file_name(){
			//echo $this->file_tem;
			//exit;
			if(!file_exists($this->file_tem)){
				echo "Upload file does not exist";
				exit;
			}					
		}
		
		//Check for file with that name is overwritten
		function check_same_file($filename){
			if(file_exists($filename)&&$this->over_write!=true){
				echo "Same name already exists！";
				exit;
			}		
		}
		
		//Moving files
		function move_file($filename,$destination){
			if(!move_uploaded_file($filename,$destination)){
				echo "Error moving files";
				exit;
			}
		}
		
		//Check whether the file is uploaded via HTTP POST
		function is_upload_file(){
			if(!is_uploaded_file($this->file_tem)){
				echo "File does not exist";
				exit;
			}
		}
		
		//Get file extension
		function getext(){
			$ext=$this->file_name;
			$extstr=explode('.',$ext);
			$count=count($extstr)-1;
			return $extstr[$count];
		}
		
		//New file name
		function set_name(){	
			return time().".".$this->getext();
		}
		
		//Create a folder name--更新20160315
		function creat_mulu($subfolder){
			if ($this->ismanager==false){
				$this->creatFolder("../".$this->file_folder."/".$subfolder);
			}else{
				$this->creatFolder("../../".$this->file_folder."/".$subfolder);
			}	
			return $this->file_folder."/".$subfolder;
		}
		
		//Generated file name --更新20160315
		function files_name(){
			$name=$this->set_name();
			
			$folder=$this->creat_mulu($this->file_subfolder);
			if ($this->ismanager==false){
				return "../".$folder."/".$name;
			}else{
				return "../../".$folder."/".$name;
			}
			
		}
		
		//Master file upload ---
		function upload_file($iscreatesimg,$simg_w,$simg_h){
			$f_name=$this->files_name();

			move_uploaded_file($this->file_tem,$f_name);

			if ($iscreatesimg==1){
				if ($this->getext()=="jpg" || $this->getext()=="gif" || $this->getext()=="bmp"  || $this->getext()=="png" || $this->getext()=="jpeg" ){
					//$this->create_simg($simg_w,$simg_h);
				}
			}
			return $f_name;
		}	
		
		//Generate thumbnails
		function create_simg($img_w,$img_h){
			$name=$this->set_name();
			$folder=$this->creat_mulu($this->file_subfolder);
			$new_name="../".$folder."/s_".$name;			
			$imgsize=getimagesize($this->files_name());
			
			 switch ($imgsize[2]){
					case 1:
							if(!function_exists("imagecreatefromgif")){
									echo "You can not use the GD library GIF format images, please use the Jpeg or PNG format! Please return";
									exit();
							}
							$im = imagecreatefromgif($this->files_name());
							break;
					case 2:
							if(!function_exists("imagecreatefromjpeg")){
									echo "You can not use the GD library image in jpeg format, please use other image formats! Please return";
									exit();
							}
							$im = imagecreatefromjpeg($this->files_name());
							break;
					case 3:
							$im = imagecreatefrompng($this->files_name());
							break;
					case 4:
							$im = imagecreatefromwbmp($this->files_name());
							break;
					default:
						die("is not filetype right");
						exit;
			}
			
			$src_w=imagesx($im);//Get image width
			$src_h=imagesy($im);//Get image height
			$new_wh=($img_w/$img_h);//New image width and height ratio
			$src_wh=($src_w/$src_h);//The original image width and height ratio
			if($new_wh<=$src_wh){
				$f_w=$img_w;
				$f_h=$f_w*($src_h/$src_w);
			}else{
				$f_h=$img_h;
				$f_w=$f_h*($src_w/$src_h);
			}
			if($src_w>$img_w||$src_h>$img_h){			
				if(function_exists("imagecreatetruecolor")){//Check function has been defined
					$new_img=imagecreatetruecolor($f_w,$f_h);
					if($new_img){
						imagecopyresampled($new_img,$im,0,0,0,0,$f_w,$f_h,$src_w,$src_h);//Resampling copy and resize part of an image
					}else{
						$new_img=imagecreate($f_w,$f_h);
						imagecopyresized($new_img,$im,0,0,0,0,$f_w,$f_h,$src_w,$src_h);
					}
				}else{
					$$new_img=imagecreate($f_w,$f_h);
					imagecopyresized($new_img,$im,0,0,0,0,$f_w,$f_h,$src_w,$src_h);
                }
				if(function_exists('imagejpeg')){
					imagejpeg($new_img,$new_name);
				}else{
					imagepng($new_img,$new_name);
				}
				imagedestroy($new_img);
			}
			//imagedestroy($new_img);
			return $new_name;
		}		
		
	}
?>