<?php

/**
 * @file
 * Contains \Drupal\products\Plugin\Block\products_qr_code_block.
 */

namespace Drupal\products\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

/**
 * Provides my custom block.
 *
 * @Block(
 *   id = "products_qr_code_block",
 *   admin_label = @Translation("Product QR Code"),
 *   category = @Translation("Blocks")
 * )
 */
class ProductQrCodeBlock extends BlockBase implements BlockPluginInterface {

    /**
     * Constructs a new BookNavigationBlock instance.
     *
     * @param array $configuration
     *   A configuration array containing information about the plugin instance.
     * @param string $plugin_id
     *   The plugin_id for the plugin instance.
     * @param mixed $plugin_definition
     *   The plugin implementation definition.
     */
    public function __construct(array $configuration, $plugin_id, $plugin_definition) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);
    }



    /**
     * {@inheritdoc}
     */
    public function build() {

        global $base_url;

        $path = \Drupal::request()->getRequestUri();
        $path = \Drupal::service('path.alias_manager')->getAliasByPath($path);
        
        $width = 250;

        $page_url = urlencode($base_url . $path);
     
        return  views_embed_view('products', 'block_1', );
    
       /* return array(
            '#theme' => 'products_qr_code_block',
            '#url' => $url,
            '#width' => $width,
            '#height' => $width,
            '#caption' => 'To Purchase this product on our app to avail exclusive app-only',
        ); */
    }

}

?>
