<?php
/**
 * @file
 * Contains \Drupal\products\Controller\ProductQrCodeGenerate
 */
 
namespace Drupal\products\Controller;
 

use Drupal\Core\Controller\ControllerBase;
use Endroid\QrCode\QrCode;
//use Drupal\products\Response\ProductQrImageResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation;
use Symfony\Component\HttpFoundation\Response;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

 
class ProductQrCodeGenerate extends ControllerBase {
    
     /**
   * Request stack.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $request;

  /**
   * QRImageGeneratorController constructor.
   *
   * @param \Symfony\Component\HttpFoundation\RequestStack $request
   *   Request object to get request params.
   */
  public function __construct(RequestStack $request) {
    $this->request = $request;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('request_stack')
    );
  }
    
    /**
   * Will return the response for external url.
   *
   * @return \Drupal\products\Response\ProductQrImageResponse
   *   Will return the image response.
   */
  public function withUrl() {
    $externalUrl = $this->request->getCurrentRequest()->query->get('path');
        $string = drupal_get_path('module', 'products') . '/images/symfony.png';
 
    
      $writer = new PngWriter();

// Create QR code
$qrCode = QrCode::create($externalUrl)
    ->setEncoding(new Encoding('UTF-8'))
    ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
    ->setSize(200)
    ->setMargin(10)
    ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
    ->setForegroundColor(new Color(0, 0, 0))
    ->setBackgroundColor(new Color(255, 255, 255));


$result = $writer->write($qrCode);
  header('Content-Type: '.$result->getMimeType());
echo $result->getString();    
  
  }
    

}
