<?php

namespace DASHIF;

class ModuleHbbTVDVB extends ModuleInterface
{
    public function __construct()
    {
        parent::__construct();
        $this->name = "HbbTV_DVB";

      ///\warn Remove global here
        global $hbbtv_conformance;
        if ($hbbtv_conformance) {
            $this->enabled = true;
        }
    }

    public function hookBeforeMPD()
    {
        parent::hookBeforeMPD();
        move_scripts();
        return HbbTV_DVB_beforeMPD();
    }

    public function hookMPD()
    {
        parent::hookMPD();
        return HbbTV_DVB_mpdvalidator();
    }

    public function hookBeforeRepresentation()
    {
        HbbTV_DVB_flags();
        return is_subtitle();
    }

    public function hookRepresentation()
    {
        return RepresentationValidation_HbbTV_DVB();
    }

    public function hookBeforeAdaptationSet()
    {
        return add_remove_images('REMOVE');
    }

    public function hookAdaptationSet()
    {
        return CrossValidation_HbbTV_DVB();
    }
}

$modules[] = new ModuleHbbTVDVB();
