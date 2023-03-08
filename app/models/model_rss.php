<?php

class model_rss extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getNews()
    {

        $sql = "SELECT a.*,b.name,c.i_image,c.i_id FROM tbl_news a
                LEFT JOIN tbl_category b
                ON a.cat_id=b.id
                LEFT JOIN tbl_images c
                ON a.image_id=c.i_id
                WHERE a.status=1
                ORDER BY a.n_id DESC LIMIT 20";
        $results = $this->doSelect($sql);

        $resName = $this->doSelect("SELECT `value` FROM tbl_settings WHERE `key`=?", array("site"), 1);

        $rss_channel = new rssGenerator_channel();
        $rss_channel->atomLinkHref = '';
        $rss_channel->title = $resName['value'];
        $rss_channel->link = URL;
        $rss_channel->description = '';
        $rss_channel->copyright = 'Copyright '.date("Y").' '.str_replace("http://","www.",URL_FOOTER);;
        $rss_channel->language = 'en-us';
        $rss_channel->generator = '';
        $rss_channel->managingEditor = '';
        $rss_channel->webMaster = '';

        foreach ($results as $result) {
            $item = new rssGenerator_item();
            $item->title = $result['title'];
            $item->description = $result['subtitle'];
            $item->link = URL.'mag/article/'.$result['n_id'].'/'.$result['title'];
            $item->enclosure_url = URL.'public/images/blog/'.$result['i_image'];
            $item->enclosure_type = 'image/jpeg';
            $item->pubDate = $result['date_created'];
            $rss_channel->items[] = $item;
        }
        $rss_feed = new rssGenerator_rss();
        $rss_feed->encoding = 'UTF-8';
        $rss_feed->version = '2.0';
        header('Content-Type: text/xml');
        return $rss_feed->createFeed($rss_channel);
    }
}


?>