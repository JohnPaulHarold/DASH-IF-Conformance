<?php
declare(strict_types=1);
require_once '../CTAWAVE_SelectionSet.php';

use PHPUnit\Framework\TestCase;

final class MediaProfileTest extends TestCase
{

    public function testAVCMediaProfile()
    {    
        
        $outfile=fopen("out.txt","w");
        $rep_count=0;
        $adapt_count=0;
        //Check for HD profile of AVC.
        $xmlParamsTobeTested=array("codec" => "AVC", "profile" => "high", "level" => "4.0",
                                   "height" => "1080" , "width"=> "1920" , "framerate" =>  "60","color_primaries" => "1",
                                   "transfer_char" => "1", "matrix_coeff" => "1", "tier" => "", "brand"=>""  );
        
        $this->assertSame("AVC_HD", checkAndGetConformingVideoProfile($xmlParamsTobeTested,$rep_count,$adapt_count,$outfile));
        
        //check that SD profile also conforms to HD profile of AVC.
        $xmlParamsTobeTested=array("codec" => "AVC", "profile" => "main", "level" => "3.1",
                                   "height" => "576" , "width"=> "864" , "framerate" =>  "30","color_primaries" => "1",
                                   "transfer_char" => "1", "matrix_coeff" => "1", "tier" => "", "brand"=>""  );
        
        $this->assertSame("AVC_HD", checkAndGetConformingVideoProfile($xmlParamsTobeTested,$rep_count,$adapt_count,$outfile));
        
    }
    
    public function testNonAVCMediaProfile()
    {
        $outfile=fopen("out.txt","w");
        $rep_count=0;
        $adapt_count=0;
        //Check for HD profile of AVC.
        $xmlParamsTobeTested=array("codec" => "AVC", "profile" => "high", "level" => "4.2",
                                   "height" => "1080" , "width"=> "1920" , "framerate" =>  "60","color_primaries" => "1",
                                   "transfer_char" => "1", "matrix_coeff" => "1", "tier" => "", "brand"=>""  );
        
        $this->assertSame("AVC_HDHF", checkAndGetConformingVideoProfile($xmlParamsTobeTested,$rep_count,$adapt_count,$outfile));
        
        //check unknown profile
        $xmlParamsTobeTested=array("codec" => "AVC", "profile" => "high", "level" => "5.0",
                                   "height" => "2160" , "width"=> "3840" , "framerate" =>  "80","color_primaries" => "1",
                                   "transfer_char" => "5", "matrix_coeff" => "6", "tier" => "", "brand"=>""  );
        
        $this->assertNotSame("AVC_HD", checkAndGetConformingVideoProfile($xmlParamsTobeTested,$rep_count,$adapt_count,$outfile));
        
    }
    
   public function testHEVCMediaProfile()
    {    
        
        $outfile=fopen("out.txt","w");
        $rep_count=0;
        $adapt_count=0;
        //Check for HD profile of AVC.
        $xmlParamsTobeTested=array("codec" => "HEVC", "profile" => "Main10", "level" => "4.1",
                                   "height" => "1080" , "width"=> "1920" , "framerate" =>  "60","color_primaries" => "1",
                                   "transfer_char" => "1", "matrix_coeff" => "1", "tier" =>"0", "brand"=>""  );
        
        $this->assertSame("HHD10", checkAndGetConformingVideoProfile($xmlParamsTobeTested,$rep_count,$adapt_count,$outfile));
        

        //Check for HD profile of AVC.
        $xmlParamsTobeTested=array("codec" => "HEVC", "profile" => "Main10", "level" => "5.1",
                                   "height" => "2160" , "width"=> "3840" , "framerate" =>  "60","color_primaries" => "9",
                                   "transfer_char" => "18", "matrix_coeff" => "9", "tier" => "0", "brand"=>""  );
        
        $this->assertSame("HLG10", checkAndGetConformingVideoProfile($xmlParamsTobeTested,$rep_count,$adapt_count,$outfile));

        //Check for HD profile of AVC.
        $xmlParamsTobeTested=array("codec" => "HEVC", "profile" => "Main", "level" => "4.1",
                                   "height" => "1080" , "width"=> "1920" , "framerate" =>  "60","color_primaries" => "1",
                                   "transfer_char" => "1", "matrix_coeff" => "1", "tier" => "0", "brand"=>""  );
        
        $this->assertSame("HHD10", checkAndGetConformingVideoProfile($xmlParamsTobeTested,$rep_count,$adapt_count,$outfile));
        
    }
    
    public function testNonHEVCMediaProfile()
    {
        $outfile=fopen("out.txt","w");
        $rep_count=0;
        $adapt_count=0;
        
        //check unknown profile
        $xmlParamsTobeTested=array("codec" => "HEVC", "profile" => "Main", "level" => "5.1",
                                   "height" => "2160" , "width"=> "3840" , "framerate" =>  "80","color_primaries" => "1",
                                   "transfer_char" => "5", "matrix_coeff" => "6", "tier" => "0", "brand"=>""  );
        
        $this->assertNotSame("HHD10", checkAndGetConformingVideoProfile($xmlParamsTobeTested,$rep_count,$adapt_count,$outfile));
        
    }
    
} 

