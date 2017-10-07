<?php

namespace App\Http\Helpers;

class Webpurify
{
  // methid is used to search given text
  public static function seachfortext($text=null)
  {
    $arr['code']='0';
    $arr['found']='0';
    $arr['message']='';
    $key= config('params.WEB_PURIFY_TEXT_API_KEY');
    $url = 'http://api1.webpurify.com/services/rest/?method=webpurify.live.check&api_key='.$key.'&text='.urlencode($text).'&ds=1&format=json';
    $response =file_get_contents($url);
    $response=json_decode($response);

    // checking for state
    if(isset($response->rsp->{'@attributes'}->stat) && $response->rsp->{'@attributes'}->stat!=null)
    {
      $stat=$response->rsp->{'@attributes'}->stat;
      if($stat=='ok'){
        if(isset($response->rsp->found) && $response->rsp->found!=null)
        {
          $arr['code']='1';
          $arr['found']=$response->rsp->found;
          $arr['message']='success';
        }
        else {
          $arr['message']="Something went wrong";
        }
      }
      else {
        if(
          isset($response->rsp->err->{'@attributes'}->code) && $response->rsp->err->{'@attributes'}->code!=null &&
          isset($response->rsp->err->{'@attributes'}->msg) && $response->rsp->err->{'@attributes'}->msg!=null
        )
        {
          $arr['message']= $response->rsp->err->{'@attributes'}->msg;
        }
        else {
          $arr['message']="Something went wrong";
        }
      }
    }
    else {
      $arr['message']="Something went wrong";
    }
    return $arr;
  }
  // method is used to search image
  public static function seachforimage($image=null)
  {
    $arr['code']='0';
    $arr['nudity']='';
    $arr['message']='';
    $key= config('params.WEB_PURIFY_IMAGE_API_KEY');
    $url = 'http://im-api1.webpurify.com/services/rest/?method=webpurify.aim.imgcheck&api_key='.$key.'&format=json&imgurl='.$image;

    $response =file_get_contents($url);
    $response=json_decode($response);

    // checking for state
    if(isset($response->rsp->{'@attributes'}->stat) && $response->rsp->{'@attributes'}->stat!=null)
    {
      $stat=$response->rsp->{'@attributes'}->stat;
      if($stat=='ok'){
        if(isset($response->rsp->nudity) && $response->rsp->nudity!=null)
        {
          $arr['code']='1';
          $arr['nudity']=$response->rsp->nudity;
          $arr['message']='success';
        }
        else {
          $arr['message']="Something went wrong";
        }
      }
      else {
        if(
          isset($response->rsp->err->{'@attributes'}->code) && $response->rsp->err->{'@attributes'}->code!=null &&
          isset($response->rsp->err->{'@attributes'}->msg) && $response->rsp->err->{'@attributes'}->msg!=null
        )
        {
          $arr['message']= $response->rsp->err->{'@attributes'}->msg;
        }
        else {
          $arr['message']="Something went wrong";
        }
      }
    }
    else {
      $arr['message']="Something went wrong";
    }
    return $arr;
  }


  // method is used to search video
  public static function seachforvideo($video=null)
  {
    $arr['code']='0';
    $arr['status']='';
    $arr['message']='';
    $key= config('params.WEB_PURIFY_VIDEO_API_KEY');
    $url = 'https://vid-api1.webpurify.com/services/rest/?method=webpurify.aim.vidcheck&api_key='.$key.'&format=json&vidurl='.$video;

    $response =file_get_contents($url);
    $response=json_decode($response);

    // checking for state
    if(isset($response->rsp->{'@attributes'}->stat) && $response->rsp->{'@attributes'}->stat!=null)
    {
      $stat=$response->rsp->{'@attributes'}->stat;
      if($stat=='ok'){
        if(isset($response->rsp->status) && $response->rsp->status!=null)
        {
          $arr['code']='1';
          $arr['status']=$response->rsp->status;
          $arr['message']='success';
        }
        else {
          $arr['message']="Something went wrong";
        }
      }
      else {
        if(
          isset($response->rsp->err->{'@attributes'}->code) && $response->rsp->err->{'@attributes'}->code!=null &&
          isset($response->rsp->err->{'@attributes'}->msg) && $response->rsp->err->{'@attributes'}->msg!=null
        )
        {
          $arr['message']= $response->rsp->err->{'@attributes'}->msg;
        }
        else {
          $arr['message']="Something went wrong";
        }
      }
    }
    else {
      $arr['message']="Something went wrong";
    }
    return $arr;
  }

}
?>
