<?php

global $uploadDefaultOptions;
$uploadDefaultOptions = array(
	"data" => array(
		"table" => "upload_files",
		"file_field" => "file",
		"key_field" => "id",
		"obj_field" => "item_id",
		"section_field"=>"item_type",
		"name_field"=>"filename",
		"type_field"=>"filetype",
		"size_field"=>"filesize",
		"hash_field"=>"filehash",
		"user_field"=>"user_id",
		"date_field"=>"date"
	),
	"crop_text" => 'Выберите область фотографии. Данная область будет отображаться на уменьшенных копиях фотографии.',
	"comment" => '',
	"limit" => 0,
	"size_limit" => 0,
	"filetype" => "",
	"crop" => false,
	"crop_options" => array(),
	"oncomplete" => "",
	"onprogress" => "",
	"autoUpload" => false,
	"autorefresh" => false,
	"autoclose" => false
);

//if(stream_resolve_include_path(MODPATH . "uploadmanager/upload.inc.php")!==false){
	include MODPATH . "uploadmanager/upload.inc.php";
//}

include_once MODPATH . "uploadmanager/php/php.php";
include_once MODPATH . "lib/wideimage/WideImage.php";
include_once MODPATH . "lib/pclzip.lib.php";

function upload_manager_options($section,$custom = array())
{
	global $uploadSections;
	global $uploadDefaultOptions;
	if($section && isset($uploadSections[$section]))
    {
		$pars = array_merge(@$uploadDefaultOptions,@$uploadSections[$section]);
		$pars = array_merge($pars,$custom);
		if(!@$pars['data'] || !@$pars['data']['table']){
			$data = $uploadDefaultOptions['data'];
			if(@$pars['data']['dir']) $data['dir'] = $pars['data']['dir'];
			$pars['data'] = $data;
		}
		
		$data = $pars['data'];
		$pars['pars'] = array();
			
		if(@$pars['obj_value']){
			$pars['pars'][$data['obj_field']] = $pars['obj_value'];
		}
		if(@$pars['key_value']){
			$pars['pars'][$data['key_field']] = $pars['key_value'];
		}
		/* high priority to the new format of data*/
		if(@$pars[$data['obj_field']]){
			$pars['pars'][$data['obj_field']] = $pars[$data['obj_field']];
		}
		if(@$pars[$data['key_field']]){
			$pars['pars'][$data['key_field']] = $pars[$data['key_field']];
		}
		if(@$pars['autosubmit']){
			$pars['autoUpload'] = $pars['autosubmit'];
		}
		
		return $pars;
	}
	return false;
}

function upload_manager_opts($section,$custom = array()){
	if($pars = upload_manager_options($section,$custom)){
		// $pars = array_map("icnv",$pars);
		$pars = json_enc($pars);
		return $pars;
	}
	return false;
}
function upload_manager_check($section,$files = array(),$r = array()){
	if($pars = upload_manager_options($section)){
		if(@$pars['check'] && is_callable($pars['check'])){
			return call_user_func($pars['check'],$files,$r);
		}
		return true;
	}
	return false;
}
function upload_manager_button_single($name, $section = "", $custom = array(), $tpl = null) {
	$pars = upload_manager_opts($section,$custom);
    if($pars!==false && upload_manager_check($section,null,$custom)){
		$name = trim($name);
		$params = " data-options='$pars' data-section='$section' data-upload='not_ready' ";
		
		if($tpl){
            if(is_callable($tpl)){
				$res = call_user_func($tpl,$name,$params);
			}
			elseif(strpos($tpl,"<% PARAMS %>") !== false){
				$res = $tpl;
				$res = str_replace('<% NAME %>', $name, $res);
				$res = str_replace('<% PARAMS %>', $params, $res);
			}
			else{
				if(preg_match("/\.tpl$/i",$tpl)){
					$tpl = stream_resolve_include_path($tpl);
					if($tpl !== false){
						$h = fopen($tpl,"r");
						$res = fread($h, filesize($tpl));
						
						$res = str_replace('<% NAME %>', $name, $res);
						$res = str_replace('<% PARAMS %>', $params, $res);
					}
				}
				elseif(preg_match("/\.php$/i",$tpl)){
					$tpl = stream_resolve_include_path($tpl);
					if($tpl !== false){
						function opopop($f,$name,$params){
							ob_start();
							@include $f;
							return ob_get_clean();
						}
						$res = opopop($tpl,$name,$params);
					}
				}
				else{
					$tpl = false;
				}
			}
		}
		
		if(!$tpl)
			$res = "<a class='attach' $params style='display: inline-block; vertical-align: bottom;'>".$name."</a>";
		
		return $res;
	}
}
function test_upload_button($name,$params){
	return "<div class='blue_button' $params><span>$name</span></div>";
}
function upload_manager_button($name, $section = "", $custom = array(), $tpl = null) {
    $pars = upload_manager_opts($section,$custom);
    if($pars!==false && upload_manager_check($section,null,$custom))
    {
        $name = trim($name);
        $params = " onclick='upload_form_new(this,\"$section\",$pars);' ";
        if($tpl)
        {
            $res = View::factory('uploadmanager/'.$tpl)
                    ->bind('params', $params)
                    ->bind('name', $name);
            //echo $res;
        }
        else
        {
            $res = "<span class='attach' $params>".$name."</span>";
        }

        return $res;
    }
}
function upload_manager_attachments_button($name, $section = "", $custom = array()) {
	$pars = upload_manager_options($section,$custom);
    if($pars!==false && @$pars['archive']){
		$data = $pars['data'];
		$tpl = "<a class='attachments' href='".base_path("/modules/uploadmanager/uploadmanager.php?action=attachments&section=$section&$data[obj_field]=".$custom[$data['obj_field']])."'>
			$name
		</a>";
		return $tpl;
	}
}
function upload_manager_download_button($name, $section = "", $file, $custom = array()) {
	$pars = upload_manager_options($section,$custom);
    if($pars!==false && @$pars['download']){
		$data = $pars['data'];
		$tpl = "<a class='download' href='".base_path("/modules/uploadmanager/uploadmanager.php?action=download&section=$section&$data[obj_field]=".$custom[$data['obj_field']]."&$data[key_field]=".$file[$data['key_field']])."'>
			$name
		</a>";
		return $tpl;
	}
}

function json_enc($a){
	return json_encode(json_icnv($a), JSON_FORCE_OBJECT);
}

function json_icnv($a){
	if(is_array($a)){
		return array_map("json_icnv",$a);
	}
	else{
		if(mb_detect_encoding($a, array('UTF-8', 'Windows-1251')) == 'UTF-8')
			return iconv("windows-1251", "utf-8",$a);
		else
			return $a;
	}
}

function upload_manager_crop_button($name, $section = "", $file, $custom = array()) {
	$pars = upload_manager_opts($section,$custom);
    if($pars!==false && upload_manager_check($section,$file,$custom)){
		$file = array('files'=>array($file));
		$file = json_encode($file);
		
		$tpl = "<a onclick='upload_crop($file,\"$section\",$pars);' id=''>
			$name
		</a>";
		
		return $tpl;
	}
}
function upload_manager_delete_button($name, $section = "", $file, $custom = array()) {
	$pars = upload_manager_opts($section,$custom);
    if($pars!==false && upload_manager_check($section,$file,$custom)){
		$file = array('files'=>array($file));
		$file = json_encode($file);
		
		$tpl = "<a onclick='upload_delete($file,\"$section\",$pars);' id=''>
			$name
		</a>";
		
		return $tpl;
	}
}

function ahi($s,$i=null,$h=1,$a=1){
	$s = ($i === null && is_ajax()) || $i ? $s : $s;
	$s = $h==2 ? htmlspecialchars($s,NO_QUOTES) : $s;
	$s = $h==1 ? htmlspecialchars($s,ENT_QUOTES) : $s;
	$s = $a ? addslashes($s) : $s;
	return $s;
}

function is_ajax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']==='XMLHttpRequest' ? 1 : 0;
}

function upload_manager_crop($section,$file){

	$opts = upload_manager_options($section);
    if($opts!==false){

		$data = $opts["data"];
		$dir = $data["dir"];
		
		$obj_value = ahi(@$file[$data['obj_field']]);
		$key_value = ahi(@$file[$data['key_field']]);
		
		if($obj_value && $key_value && upload_manager_check($section,$file)){
			
			if($opts['crop']){
				$w = intval(@$file['width']);
				$h = intval(@$file['height']);
				$x = intval(floatval(@$file['x'])*$w);
				$y = intval(floatval(@$file['y'])*$h);
				if(@$opts['crop_options']['real']){
					// if(!file_exists($opts['crop_options']['dir'].$file)){
						//gen_images_img_cache
						// gen_img_cache($opts['crop_options']['dir'].$file,false);
					// }
					//crop
					$crop_dir = $opts['data']['dir']."cropped/";
					$crop_path = stream_resolve_include_path($crop_dir);
					
					if ($crop_path===false) {
						mkdir(get_include_path().$crop_dir, 0777, true);
						chmod(get_include_path().$crop_dir, 0777);
						$crop_path = stream_resolve_include_path($crop_dir);
					}
					
					// $path = stream_resolve_include_path($opts['crop_options']['dir']);
					$path_ = stream_resolve_include_path($opts['data']['dir']);
					
					$file_name = $file[$data['file_field']];
					$img = WideImage::load($path_."/".$file_name);
					$x_ = floatval(@$file['x']) * 100;
					$y_ = floatval(@$file['y']) * 100;
					$img = $img->resize($opts['crop_options']['width'], $opts['crop_options']['height'],"outside");
					$img = $img->crop($x_."%",$y_."%",$opts['crop_options']['width'],$opts['crop_options']['height']);
					$img->saveToFile($crop_path."/".$file_name);
				}
				$wh = @$data['section_field'] ? "and $data[section_field]='$section'" : "";
				$cropSql = "x='$x',y='$y'";
                
				$sql = "UPDATE $data[table] SET $cropSql WHERE $data[key_field] = '$key_value' and $data[obj_field] = '$obj_value' $wh";

				DB::query(Database::UPDATE, $sql)->execute();
                //mysql_query_ex($sql);
				
				return array("success"=>1,"files"=>array(get_field_value_where("","$data[table]","$data[key_field] = '$key_value' and $data[obj_field] = '$obj_value' $wh")));
			}
			
		}
	}
}

function mysql_array($res,$f = ""){
	$n = array();
	while($r = mysql_fetch_assoc($res)){
		if($f)
			$n[$r[$f]] = $r;
		else
			$n[] = $r;
	}
	return $n;
}

function mysql_query_ex($sql,$echo=0){
    if ($echo){
		echo "<pre>".$sql."</pre>";
	}
	$r = mysql_query($sql) or die("неверный запрос: " . mysql_error());
    return $r;
}

function my_uniqid() {
    $uniq_id = md5(uniqid(rand(), 1));
    return $uniq_id;
}

function upload_manager_upload($section,$r){
	$opts = upload_manager_options($section);
    if($opts!==false)
    {
        $data = $opts["data"];
		$dir = $data["dir"];
		$fields = @$r['fields'] && is_array($r['fields']) ? $r['fields'] : array();
		$status = isset($opts['default_status']) ? intval($opts['default_status']) : 1;
		
		$obj_value = ahi(@$r[$data['obj_field']]);
		$key_value = ahi(@$r[$data['key_field']]);
		if(($obj_value || $key_value) && upload_manager_check($section,$r)){
			// $names = uploadHelper::getVar('file');
			// $files = uploadHelper::getVar('file_file');
			
			$wh = @$data['section_field'] ? "and $data[section_field]='$section'" : "";
			
			$i = 0;
			if(@$opts["limit"] == 1)
            {
                $ssql = "select * from $data[table] where $data[obj_field]='$obj_value' $wh";
				//$res = mysql_array(mysql_query_ex("select * from $data[table] where $data[obj_field]='$obj_value' $wh"));
				$res = DB::query(Database::SELECT, $ssql)->execute()->as_array();
                foreach($res as $key => $r){
					$file_ = $r[$data["file_field"]];
					$filename_ = stream_resolve_include_path($dir.$file_);
					if($filename_!==false){
						unlink($filename_);
					}
				}
                DB::query(Database::DELETE, "delete from $data[table] where $data[obj_field]='$obj_value' $wh")->execute();
				//mysql_query_ex("delete from $data[table] where $data[obj_field]='$obj_value' $wh");
			}
			$files_ = array();
			// foreach($files as $k => $file){
				
				$new_path = stream_resolve_include_path($dir);
				if($new_path === false){
					mkdir(get_include_path().$dir, 0777, true);
					chmod(get_include_path().$dir, 0777);
					$new_path = stream_resolve_include_path($dir);
				}
				$new_name = my_uniqid();
				
				$allowedExtensions = @$opts['filetype'] ? explode(",",$opts['filetype']) : null;
				$sizeLimit = @$opts['size_limit'] ? $opts['size_limit'] : null;
				
                                $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
				$result = $uploader->handleUpload($new_path,$new_name);
				

				// if(!@$opts['filetype'] || in_array(strtolower($ext),explode(",",$opts['filetype']))){
				if($result['success'])
                                {
					// uploadHelper::file_copy($new_filename,$old_filename);
					// $files[$k] = uploadHelper::decrypt($file);
					$ext = $result['ext'];
					$cnt = 1;
					$extension = str_replace(".","",$result['ext'],$cnt);
					$name = ahi($result['name'],1,0,1);
					$size = $result['size'];
					$hash = md5(file_get_contents($result['path']));
					$user_id = intval(@$_SESSION['user_id']);
					$date = date("Y-m-d H:i:s");
					
					$new_name = $new_name.$ext;
					
					
					$new_filename = $result['path'];
					
					if(@$opts['resize']){
						$width = isset($opts['resize']['width']) ? $opts['resize']['width'] : null;
						$height = isset($opts['resize']['height']) ? $opts['resize']['height'] : null;
						
						$mode = isset($opts['resize']['mode']) ? $opts['resize']['mode'] : 'inside';
						$scale = isset($opts['resize']['scale']) ? $opts['resize']['scale'] : 'down';
						
						if(!$height && !$width){
							$height = 1000;
							$width = 1000;
						}
                                                
                                                $img = WideImage::load($new_filename);
						$img = $img->resize($width, $height,$mode,$scale);
						$img->saveToFile($new_filename);

						$h = $img->getHeight();
						$w = $img->getWidth();
                                                
						$x = 0;
						$y = 0;
					}
					
					$sort = 0;
					$cropSql = @$opts['crop'] ? ",x='$x',y='$y',width='$w',height='$h'" : "";
					
					$add_fields = "";
					$add_fields .= @$data['section_field'] ? "$data[section_field]='$section'," : "";
					$add_fields .= @$data['name_field'] ? "$data[name_field]='$name'," : "";
					$add_fields .= @$data['type_field'] ? "$data[type_field]='$extension'," : "";
					$add_fields .= @$data['size_field'] ? "$data[size_field]='$size'," : "";
					$add_fields .= @$data['hash_field'] ? "$data[hash_field]='$hash'," : "";
					$add_fields .= @$data['user_field'] ? "$data[user_field]='$user_id'," : "";
					$add_fields .= @$data['date_field'] ? "$data[date_field]='$date'," : "";
					
					foreach($fields as $f_ => $v_){
						$add_fields .= $f_ ? "$f_='$v_'," : "";
					}
					
					/*mysql_query_ex("insert into $data[table] 
						set $data[obj_field]='$obj_value',
							$data[file_field]='$new_name',
							$add_fields
							status='$status', 
							sort='$sort'
							$cropSql
					");*/
                    $sqli = "insert into $data[table] 
						set $data[obj_field]='$obj_value',
							$data[file_field]='$new_name',
							$add_fields
							status='$status', 
							sort='$sort'
							$cropSql
					";
                    
                    DB::query(Database::INSERT, $sqli)->execute();
                    
					$file_id = mysql_insert_id();
					$ff = get_field_value_where("","$data[table]","$data[obj_field]='$obj_value' and $data[key_field]='$file_id' $wh");
					$files_[] = $ff;
					// $files_[] = array(
						// "$data[file_field]"=>"$new_name",
						// "$data[key_field]"=> mysql_insert_id(),
						// "$data[obj_field]"=> $obj_value,
						// "width"=>$w,
						// "height"=>$h,
						// "x"=>$x,
						// "y"=>$y
					// );
					if(@$opts['crop'] && @$opts['crop_options']['real'])
						upload_manager_crop($section,$ff);
						
					if(@$opts['onregister'] && is_callable(@$opts['onregister'])){
						call_user_func($opts['onregister'],$section,$files_,$r);
					}
					return array("success"=>$result['success'],"files"=>$files_);
				}
				else{
					return array("success"=>$result['success'],"error"=>@$result['error']);
				}
			// }
			
		}
		else{
			return array("success"=>0,"error"=>"no_access");
		}
	}
}

function get_field_value_where($field,$table_name,$where,$echo=0)
{
	$sql_select="select * from $table_name where $where";
	$query = DB::query(Database::SELECT, $sql_select)->execute()->as_array();
    foreach($query as $key => $record)
    {
        return $field ? $record[$field] : $record;
    }
    /*while ($record = mysql_fetch_assoc($sql_select)){
		return $field ? $record[$field] : $record;
	}*/
}

function upload_manager_delete($section,$file){
	$opts = upload_manager_options($section);
    if($opts!==false){

		$data = $opts["data"];
		$dir = $data["dir"];
		
		$obj_value = ahi(@$file[$data['obj_field']]);
		$key_value = ahi(@$file[$data['key_field']]);
		
		if($obj_value && $key_value && upload_manager_check($section,$file)){
			$wh = @$data['section_field'] ? "and $data[section_field]='$section'" : "";
			
			$res = Model::factory('Admin_User')->test($data[table], $data[key_field], $key_value, $wh);
            
            //$res = mysql_array(mysql_query_ex("select * from $data[table] where $data[key_field]='$key_value' $wh"));
			foreach($res as $key => $r)
            {
				$file_ = $r[$data["file_field"]];
				$filename_ = stream_resolve_include_path($dir.$file_);
				if($filename_!==false){
					unlink($filename_);
				}
				//mysql_query_ex("delete from $data[table] where $data[key_field]='$key_value' $wh");
				DB::query(Database::DELETE, "delete from $data[table] where $data[key_field]='$key_value' $wh")->execute();
                return array("success"=>1,"files"=>array($file));
			}
			
		}
	}
}
function upload_manager_get_files($section,$r = array(),$ignore_single = false,$pages_config = array()){
	$opts = upload_manager_options($section);
    if($opts!==false){

		$data = $opts["data"];
		$dir = $data["dir"];
		
		$obj_value = ahi(@$r[$data['obj_field']]);
		$key_value = $ignore_single ? 0 : ahi(@$r[$data['key_field']]);
		
		if($obj_value || $key_value){
			$wh = "";
			$wh .= @$data['section_field'] ? "and $data[section_field]='$section'" : "";
			$wh .= $obj_value ? "and $data[obj_field]='$obj_value'" : "";
			$wh .= $key_value ? "and $data[key_field]='$key_value'" : "";
			if(@$opts['limit']==1){
				$res = get_field_value_where("","$data[table]","status='1' $wh");
			}
			else{
				// pages config
				DB::query( Database::SELECT, "select * from $data[table] where status='1' $wh".(@$data['key_field'] ? "order by ".$data['key_field']." desc" : ""))->execute()->as_array();
                //$res = mysql_array(mysql_query_ex("select * from $data[table] where status='1' $wh".(@$data['key_field'] ? "order by ".$data['key_field']." desc" : "")));
			}
			return $res;
		}
	}
}

function show_files($section,$r,$v){
	$res = "";
	
	if(!empty($r)){
		$count = count($r);
		$res .= "<div class='files $section'>";
		$res .= "<p class='info'>Прикреплено: <span class='count'>".$count." файл".numberEnd($count,array('','а','ов'))."</span> ".upload_manager_attachments_button("скачать архив",$section, $v)."</p>";
		
		foreach($r as $file){
			$actions = $file['user_id'] && $file['user_id'] == @$_SESSION['user_id'] ? "<span class='actions'>".upload_manager_delete_button("удалить","$section",$file)."</span>" : "";
			$res .= "<div class='item type_$file[filetype]'>
				<i class='icon i-file_icon i-$file[filetype]'></i>
				".upload_manager_download_button("$file[filename].$file[filetype]",$section, $file, $v)."
				<span class='size'>"._size($file['filesize'])."</span>
				$actions
			</div>";
		}
		$res .= "</div>";
	}
	else{
		
	}
	

	return $res;
	
}
/* default template */
function upload_manager_show_files($section,$files = array(),$r = array(),$template = "dbg"){
	$opts = upload_manager_options($section);
    if($opts!==false){
		if(is_callable($template)){
			// echo dbg($files);
			return call_user_func($template,$section,$files,$r);
		}
	}
}
function icnv($a){
	if(is_array($a))
		return array_map("icnv",$a);
	else {
        if(mb_detect_encoding($a, array('UTF-8', 'Windows-1251')) == 'UTF-8')
			return iconv("windows-1251", "utf-8",$a);
		else
			return $a;
    }
		//return iconv("windows-1251", "utf-8",$a);
}
function icnv_($a){
	if(is_array($a)){
		return array_map("icnv_",$a);
	}
	else{
		if(mb_detect_encoding($a, array('UTF-8', 'Windows-1251')) == 'UTF-8')
			return iconv("windows-1251", "utf-8",$a);
		else
			return $a;
	}
}
function cnv_($a){
	return array_map("icnv_",$a);
}
/* спижжено с форума */
function _size($file_size){
	$file_size = $file_size-1;
	if ($file_size >= 1099511627776) $show_filesize = number_format(($file_size / 1099511627776),2) . " тб.";
	elseif ($file_size >= 1073741824) $show_filesize = number_format(($file_size / 1073741824),2) . " гб.";
	elseif ($file_size >= 1048576) $show_filesize = number_format(($file_size / 1048576),2) . " мб.";
	elseif ($file_size >= 1024) $show_filesize = number_format(($file_size / 1024),2) . " кб.";
	elseif ($file_size > 0) $show_filesize = $file_size . " б.";
	elseif ($file_size == 0 || $file_size == -1) $show_filesize = "0 б.";
	
	return $show_filesize;
}
