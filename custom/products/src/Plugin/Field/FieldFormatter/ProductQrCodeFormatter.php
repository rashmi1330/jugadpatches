<?php

namespace Drupal\products\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Component\Utility\UrlHelper;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Plugin implementation of the 'product_qr_code' formatter.
 *
 * @FieldFormatter(
 *   id = "product_qr_code_formatter",
 *   label = @Translation("Product Qr Code"),
 *   field_types = {
 *     "link"
 *   }
 * )
 */
class ProductQrCodeFormatter extends FormatterBase {


  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];
    foreach ($items as $delta => $item) {
      // Get a URL from the field and make it absolute.
      $url = $item->getUrl()->setAbsolute(TRUE)->toString();
      // Just in case, sanitize entered URL.
      $url =  UrlHelper::filterBadProtocol($url);
      // Use image theme function to render a QR code image for the URL.
        
        $option = [
            'query' => ['path' => $url],
          ];
          $uri = Url::fromRoute('products.qr.url', [], $option)
            ->toString();
       // $productqr_code = new ProductQrCodeGenerate;
       // $uri = $productqr_code->generateQrCodes($url);
        
        $element[$delta] = [
          '#theme' => 'image',
          //'#uri' => 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . $url,
          '#uri' => $uri,
          //'#attributes' => ['class' => 'module-name-center-image'],
        ];

    }

    return $element;
  }

}
