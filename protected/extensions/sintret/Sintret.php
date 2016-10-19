<?php

/**
 * Loading Social Images Extension class file.
 *
 *
 * @author Andifitria <sintret@gmail.com>
 * @copyright Copyright &copy; 2013 Andifitria
 * @license BSD
 *
 * @link http://www.yiiframework.com/extension/sintret
 *
 * @package Sintret.Sintret
 * @version $Id:$ (1.0)
 */

/**
 * Sintret
 *
 */
class Sintret extends CApplicationComponent
{

    public $foursquare_client_key;
    public $foursquare_client_secret;
    public $flickr_key;

    public function foursquare($venueId)
    {
        $return = array();
        $url = 'https://api.foursquare.com/v2/venues/' . $venueId . '/photos?client_id=' . $this->foursquare_client_key . '&client_secret=' . $this->foursquare_client_secret;
        $json = $this->curl($url);
        $array = CJSON::decode($json);
        $items = $array['response']['photos']['groups'][1]['items'];
        if ($items)
            foreach ($items as $item) {
                $thumbnail = empty($item['sizes']['items'][1]['url']) ? $item['sizes']['items'][1]['url'] : $item['sizes']['items'][1]['url'];
                $return[] = array(
                    'id' => $item['id'],
                    'createVendor' => date('Y-m-d H:i:s', $item['createdAt']),
                    'thumbnail' => $thumbnail,
                    'original' => $item['url'],
                );
            }
        return $return;
    }

    public function facebook($fbId)
    {
        //Examples https://graph.facebook.com/22934684677/albums
        $photo = array();
        $return = array();
        $url = 'https://graph.facebook.com/' . $fbId . '/albums';
        $curl = $this->curl($url);
        if ($curl)
            $albums = CJSON::decode($curl);

        if ($albums['data'])
            foreach ($albums['data'] as $album) {
                $photos[] = $album['id'];
            }

        // Example, http://graph.facebook.com/151182761579676/photos
        if ($photos)
            foreach ($photos as $photo) {
                $urlPhoto = 'http://graph.facebook.com/' . $photo . '/photos';
                $curlPhoto = $this->curl($urlPhoto);
                $curlPhotoJSON = CJSON::decode($curlPhoto);

                if ($curlPhotoJSON['data'])
                    foreach ($curlPhotoJSON['data'] as $data) {
                        $return[] = array(
                            'id' => $data['id'],
                            'createVendor' => date('Y-m-d H:i:s', strtotime($data['created_time'])),
                            'thumbnail' => $data['picture'],
                            'original' => $data['source'],
                        );
                    }
            }
        return $return;
    }

    public function instagram()
    {

    }

    public function flickr($search, $perPage = NULL)
    {
        /* photos_search by
         * user_id,tags,tag_mode,text,min_upload_date,max_upload_date,min_taken_date,max_taken_date,license,sort,
         * privacy_filter,bbox,accuracy,safe_search,content_type,machine_tags,
         */
        if (empty($perPage))
            $perPage = 100;

        $url = 'http://api.flickr.com/services/rest/?method=flickr.photos.search';
        $url.= '&api_key=' . $this->flickr_key;
        $url.= '&tags=' . $search;
        $url.= '&per_page=' . $perPage;
        $url.= '&format=json';
        $url.= '&nojsoncallback=1';
        $curl = $this->curl($url);
        if ($curl)
            $array = CJSON::decode($curl);
        $count = count($array['photos']['photo']);
        for ($i = 0; $i < $count; $i++) {
            if ($array['photos']['photo'][$i]["ispublic"] == 1) {
                $id = $array['photos']['photo'][$i]["id"];
                $owner = $array['photos']['photo'][$i]["owner"];
                $secret = $array['photos']['photo'][$i]["secret"];
                $server = $array['photos']['photo'][$i]["server"];
                $farm = $array['photos']['photo'][$i]["farm"];
                $title = $array['photos']['photo'][$i]["title"];
                $image = "http://farm" . $farm . ".static.flickr.com/" . $server . "/" . $id . "_" . $secret . ".jpg";
                $thumbnail = "http://farm" . $farm . ".static.flickr.com/" . $server . "/" . $id . "_" . $secret . "_t.jpg";

                $return[] = array(
                    'id' => $id,
                    'thumbnail' => $thumbnail,
                    'original' => $image,
                    'createVendor' => date('Y-m-d H:i:s'),
                );
            }
        }

        return $return;
    }

    public function curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}
