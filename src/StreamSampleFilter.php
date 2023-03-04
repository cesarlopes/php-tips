<?php

class StreamSampleFilter extends php_user_filter
{
    public $stream;

    public function onCreate()
    {
        $this->stream = fopen('php://temp', 'w+');
        return $this->stream !== false;
    }

    public function filter($in, $out, &$consumed, $closing)
    {
        $saida = '';
        while ($bucket = stream_bucket_make_writeable($in)) {
            $linhas = explode("\n", $bucket->data);

            foreach ($linhas as $linha) {
                if (stripos($linha, 'parte') !== false) {
                    $saida .= "$linha\n";
                }
            }
        }

        $bucketSaida = stream_bucket_new($this->stream, $saida);
        stream_bucket_append($out, $bucketSaida);

        return PSFS_PASS_ON;
    }
}
/*
class StreamSampleFilter2 extends php_user_filter
{
    private $previousData;

    public function filter($in, $out, &$consumed, $closing)
    {
        $saida = '';

        while ($bucket = stream_bucket_make_writeable($in)) {
            if ($closing && !$bucket->datalen) {
                return PSFS_FEED_ME;
            }
            $consumed += $bucket->datalen;

            $stringFromBucket = $bucket->data;
            if (!empty($this->previousData)) {
                $stringFromBucket = $this->previousData . $bucket->data;
                $this->previousData = null;
            }

            if ($stringFromBucket[-1] !== "\n") {
                $this->previousData = $stringFromBucket;
                return PSFS_FEED_ME;
            }

            $linhas = explode("\n", $stringFromBucket);

            foreach ($linhas as $linha) {
                if (stripos($linha, 'parte') !== false) {
                    $saida .= "$linha\n";
                }
            }
        }

        $bucketSaida = stream_bucket_new($this->stream, $saida);
        stream_bucket_append($out, $bucketSaida);

        return PSFS_PASS_ON;
    }
}
*/


//EXEMPLO 
$sampleFile = fopen('file-ro-read.txt', 'r');
stream_filter_register('naming.filter', StreamSampleFilter::class);
stream_filter_append($sampleFile, 'naming.filter');


//https://github.com/clue/stream-filter


//https://www.php.net/manual/en/wrappers.php.php
