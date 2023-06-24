<?php 

namespace App\Helpers;
use DB;
use Auth;
use Session;
use Cache;
use \Datetime;
use App\Helpers\ImageUtil;
class Helper
{
 
    public static function inlineEditable($element,$styles,$textContent,$key,$returnResult=false){
        $creating = "<".$element;
        $elementId = debug_backtrace();
      //  dd($elementId);
        // $id = $key.$elementId[0]['line'];
        $id = $key;
        if($returnResult){
          $id = $key;
        }
      // $m_flag = Cache::remember('m_flag', 1, function() {
      //   $data = DB::SELECT("SELECT * FROM m_flag");
      //   $arr = array();
      //   foreach($data as $dat){
      //     $arr[$dat->flag_type] = $dat;
      //   }
      //   return $arr;
      // });
      // if(isset($m_flag[$id])){
      //   $textContent = $m_flag[$id]->flag_additionalText;
      // }
        $db = self::returnRow("m_flag"," flag_type = '".$id."'");
        if($db){
          if($element=='a'){
              if(empty($styles)){
                $styles = array("href"=>$db->flag_show_text);
              } else {
                $styles['href'] = $db->flag_show_text;
              }
          }
          $textContent = $db->flag_additionalText;
        }
        if(is_admin()){
          if(admin()->is_active=='1'){
            if($element=='a'){
              $creating.=' data-anchorupdate="true" data-before="" data-update="'.$id.'" ';
            } else {
              $creating.=' contenteditable="true" data-before="" data-update="'.$id.'" ';
            }
          }
        }
        if(is_array($styles)){
          if(count($styles)>0){
            foreach($styles as $key=>$values){
              $class = trim($values);
              $creating.= ' '.$key.'="'.$class.'" ';
            }
          }
        }
        $creating.='>';
        $creating.=$textContent;
        $creating.="</".$element.">";
        if($returnResult){
          return html_entity_decode($creating);
        } else {
          print html_entity_decode($creating);
        }
      }

      public static function returnRow($table,$where){
        $whereCond = $where=='' ? '' : ' WHERE '.$where;
        $data = collect(\DB::select("SELECT * FROM ".$table." ".$whereCond))->first();
        return $data;
    }

    

    public static function OneColData($table,$col,$condition,$modifiedCol=""){
      $where = $condition=='' ? '' : ' WHERE '.$condition;
      $data = collect(\DB::select("SELECT ".$col." FROM ".$table." ".$where))->first();
    if($data){
      if($modifiedCol!=""){
        return $data->$modifiedCol;
      }
      return $data->$col;
    }else{
      return '';
    }
    }

    public static function setbackground($default,$styles,$key,$hardUrl,$width,$height){
      $elementId = debug_backtrace();
      $id = $key.$elementId[0]['line'];

      $creating = 'style="';
      $classAft = '';
      if(is_array($styles)){
        if(count($styles)>0){
          foreach($styles as $key=>$values){
            $class = trim($values);
            $classAft.= ''.$key.':'.$class.';';
          }
        }
      }
      $db = self::OneColData("imagetable","img_path"," imagetable.table_name = '".$id."' and imagetable.ref_id = 0 and imagetable.type='1' and imagetable.is_active_img='1'");
      if($db!=""){
        $default = $db;
        $hardUrl.='Uploads/';
      }
      $creating.='background-image:url('.$hardUrl.''.$default.');';
      $creating.=$classAft;
      $creating.='" data-width="'.$width.'" data-height="'.$height.'" contentbackground="true" data-key="'.$id.'"';
      print $creating;
    }

    public static function dynamicImagesTable($imageUrl,$styles,$key,$common){
      //dd('dsadsa');
      $element='img';
      $creating = "<".$element;
	  $id = $key;
      if(is_array($styles)){
        if(count($styles)>0){
          foreach($styles as $key=>$values){
            $class = trim($values);
            $creating.= ' '.$key.'="'.$class.'" ';
          }
        }
      }
      $creating.='data-url="'.$imageUrl.'"';
      if(is_adminiy()){
        if(adminiy()->is_active=='1'){
			$creating.=' data-key="'.$id.'" ';
			$creating.=' data-imgid = "'.$id.'"';
			$creating.=' data-table="'.$common[0].'"';
			$creating.=' data-ref_id="'.$common[1].'"';
        }
      }
      $creating.="/>";
      print $creating;
    }

    public static function dynamicImages($hardUrl,$default,$styles,$key,$returnResult=false){
     // dd($hardUrl);
      $element='img';
      $creating = "<".$element;
      $elementId = debug_backtrace();
    //  dd($elementId);
      // $id = $key.$elementId[0]['line'];
      $id = $key;
      if($returnResult){
        $id = $key;
        //dd($id);
      }
     // dd($id);
      //$db = self::OneColData("imagetable","img_path"," imagetable.table_name = '".$id."' and imagetable.ref_id = 0 and imagetable.type='1' and imagetable.is_active_img='1'");
    $imageRow =  self::returnRow("imagetable"," imagetable.table_name = '".$id."' and imagetable.ref_id = 0 and imagetable.type='1'");
   // dd($imageRow);
    $db = '';
    if($imageRow){
      $db = $imageRow->img_path;
     // dd($db);
      if(!empty($imageRow->img_href)){
        $creating = '<a href="'.$imageRow->img_href.'">'.$creating;
      }
    }
  //  dd($styles);

  if(!isset($imageRow))
  {
    // dd($imageRow);
    if(!isset($imageRow->img_width) && !isset($imageRow->img_height))
    {
    if(is_array($styles)){
      if(count($styles)>0){
       // dd($styles);
        foreach($styles as $key=>$values){
          $class = trim($values);
          $creating.= ' '.$key.'="'.$class.'" ';
        }
      }
    }
    }
  }
    else
    {
      $styleclass= $styles['class'];
     // dd($styleclass);
      $styles = array();
      $styles = ['data-width' => $imageRow->img_width,'data-height' => $imageRow->img_height, 'class' => $styleclass];
      foreach($styles as $key=>$values){
        $class = trim($values);
        $creating.= ' '.$key.'="'.$class.'" ';
      }
    //  dd($styles);
    }
      if($db!=""){
    if($imageRow->is_active_img=='1'){
      $default = $db;
      $hardUrl.='';
      $hardUrl='';
     // dd($imageRow);
      $default=ImageUtil::gethref($imageRow->id,$styles['data-width'],$styles['data-height']);
     // dd($default);
      
    }
    else if($imageRow->is_active_img=='0' && is_admin()){
      if(admin()->is_active=='1'){
        $default = $db;
        $hardUrl.='';
      } else {
        $default = '';
      if($returnResult){
      return '';
      } else {
      print '';
      return;
      }
      }
    }
    else {
      $default = '';
      if($returnResult){
      return '';
      } else {
      print '';
      return;
      }
    }
      } else { $hardUrl.=''; }
      $imageUrl = $hardUrl.''.$default;
      //dd($imageUrl);
      $creating.='data-url="'.$imageUrl.'"';
      if(is_admin()){
        if(admin()->is_active=='1'){
          $creating.=' data-key="'.$id.'" ';
      if($db!=""){
        $creating.=' data-imgid = "'.$imageRow->id.'"';
      }
        }
      }
      $creating.="/>";
      if($db!=""){
        if(!empty($imageRow->img_href)){
         $creating.='</a>';
        }
      }
      if($returnResult){
        return $creating;
      } else {
        print $creating;
      }
    }
   
 

}