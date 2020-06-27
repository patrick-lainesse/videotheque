<?php
// TODO: tester / modifier ce code
// Source: https://stackoverflow.com/questions/18679004/how-to-get-the-url-of-the-first-youtube-video-from-a-search

// Call set_include_path() as needed to point to your client library.
require_once ('video/Google_Client.php');
require_once ('video/Google_YouTubeService.php');

/* Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
Google APIs Console <http://code.google.com/apis/console#access>
Please ensure that you have enabled the YouTube Data API for your project. */
$DEVELOPER_KEY = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

$client = new Google_Client();
//$client->setDeveloperKey($DEVELOPER_KEY);

$youtube = new Google_YoutubeService($client);

try {
    $searchResponse = $youtube->search->listSearch('id,snippet', array(
        'q' => $_POST['query'],
        'maxResults' => '48',
    ));

    $videos = '';
    $channels = '';

    foreach ($searchResponse['items'] as $searchResult) {
        switch ($searchResult['id']['kind']) {
            case 'youtube#video':
                $videos .=  $searchResult;


                break;

        }
    }

} catch (Google_ServiceException $e) {
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
        htmlspecialchars($e->getMessage()));
} catch (Google_Exception $e) {
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
        htmlspecialchars($e->getMessage()));
}


echo print_r($videos);
?>
