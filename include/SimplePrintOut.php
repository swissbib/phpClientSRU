<?php
/**
 * Created by PhpStorm.
 * User: swissbib
 * Date: 26.02.15
 * Time: 21:56
 */

class SimplePrintOut {


    public function printOut(SwissbibResponse $response)
    {

        echo "<!DOCTYPE html>";
            echo "<html>";
            echo '<head lang="en">';
            echo '<meta charset="UTF-8">';
            echo '<title></title>';
            echo '</head>';
            echo '<body>';

                echo "<div>number of hits: " . $response->getHits() . "</div>";
                foreach ($response->getValueObjects() as $document) {

                    echo "<div>titel: " . $document->getTitle() . "</div>";
                    echo "<div>Backlinks to items:</div>";
                    foreach ($document->getItems() as $item) {
                        echo "<div><a href=" . $item->getBacklink() ." target='_blank'  >link to library</a></div>";
                    }
                }

            echo '</body>';
            echo '</html>';

    }
}