<?php
/**
 * Load create template page
 *
 * @package modx
 * @subpackage manager.controllers
 */
class ElementTVUpdateManagerController extends modManagerController {
    /** @var modCategory $category */
    public $category;
    /** @var modTemplateVar $tv */
    public $tv;
    /** @var array $tvArray */
    public $tvArray = array();
    /** @var string $onTVFormRender */
    public $onTVFormRender = '';
    /** @var string $onTVFormPrerender */
    public $onTVFormPrerender = '';

    /**
     * Check for any permissions or requirements to load page
     * @return bool
     */
    public function checkPermissions() {
        return $this->modx->hasPermission('edit_tv');
    }

    /**
     * Register custom CSS/JS for the page
     * @return void
     */
    public function loadCustomCssJs() {
        $mgrUrl = $this->modx->getOption('manager_url',null,MODX_MANAGER_URL);
        $this->addJavascript($mgrUrl.'assets/modext/widgets/core/modx.grid.local.property.js');
        $this->addJavascript($mgrUrl.'assets/modext/widgets/element/modx.grid.element.properties.js');
        $this->addJavascript($mgrUrl.'assets/modext/widgets/element/modx.grid.tv.template.js');
        $this->addJavascript($mgrUrl.'assets/modext/widgets/element/modx.grid.tv.security.js');
        $this->addJavascript($mgrUrl.'assets/modext/widgets/element/modx.panel.tv.js');
        $this->addJavascript($mgrUrl.'assets/modext/sections/element/tv/update.js');
        $this->addHtml('
        <script type="text/javascript">
        // <![CDATA[
        MODx.onTVFormRender = "'.$this->onTVFormRender.'";
        MODx.perm.unlock_element_properties = "'.($this->modx->hasPermission('unlock_element_properties') ? 1 : 0).'";
        Ext.onReady(function() {
            MODx.load({
                xtype: "modx-page-tv-update"
                ,id: "'.$this->tvArray['id'].'"
                ,record: '.$this->modx->toJSON($this->tvArray).'
            });
        });
        // ]]>
        </script>');
    }

    /**
     * Custom logic code here for setting placeholders, etc
     * @param array $scriptProperties
     * @return mixed
     */
    public function process(array $scriptProperties = array()) {
        $placeholders = array();

        /* load tv */
        if (empty($scriptProperties['id'])) return $this->failure($this->modx->lexicon('tv_err_ns'));
        $this->tv = $this->modx->getObject('modTemplateVar',$scriptProperties['id']);
        if ($this->tv == null) return $this->failure($this->modx->lexicon('tv_err_nf'));
        if (!$this->tv->checkPolicy('view')) return $this->failure($this->modx->lexicon('access_denied'));

        /* get properties */
        $properties = $this->tv->get('properties');
        if (!is_array($properties)) $properties = array();

        $data = array();
        foreach ($properties as $property) {
            $data[] = array(
                $property['name'],
                $property['desc'],
                $property['type'],
                $property['options'],
                $property['value'],
                $property['lexicon'],
                false, /* overridden set to false */
                $property['desc_trans'],
            );
        }
        $this->tvArray = $this->tv->toArray();
        $this->tvArray['properties'] = $data;

        $this->tvArray['sources'] = $this->getElementSources();

        /* load tv into parser */
        $placeholders['tv'] = $this->tv;

        /* invoke OnTVFormRender event */
        $placeholders['onTVFormRender'] = $this->fireRenderEvent();

        return $placeholders;
    }

    public function getElementSources() {
        $c = $this->modx->newQuery('modContext');
        $c->leftJoin('sources.modMediaSourceElement','SourceElements',array(
            'SourceElements.object' => $this->tv->get('id'),
            'SourceElements.object_class' => $this->tv->_class,
            'SourceElements.context_key = modContext.key',
        ));
        $c->leftJoin('sources.modMediaSource','Source','SourceElements.source = Source.id');
        $c->select($this->modx->getSelectColumns('modContext','modContext'));
        $c->select($this->modx->getSelectColumns('sources.modMediaSourceElement','SourceElements'));
        $c->select($this->modx->getSelectColumns('sources.modMediaSource','Source','',array('name')));
        $c->where(array(
            'key:!=' => 'mgr',
        ));
        $c->sortby($this->modx->escape('rank'),'ASC');
        $c->sortby($this->modx->escape('key'),'DESC');
        $contexts = $this->modx->getCollection('modContext',$c);
        $list = array();
        /** @var modContext $context */
        foreach ($contexts as $context) {
            $source = $context->get('source');
            $list[] = array(
                $context->get('key'),
                !empty($source) ? $source : 1,
                $context->get('name'),
            );
        }
        return $list;
    }

    /**
     * Invoke OnTVFormPrerender event
     * @return void
     */
    public function firePreRenderEvents() {
        /* PreRender events inject directly into the HTML, as opposed to the JS-based Render event which injects HTML
        into the panel */
        $this->onTVFormPrerender = $this->modx->invokeEvent('OnTVFormPrerender',array(
            'id' => $this->tvArray['id'],
            'tv' => &$this->tv,
            'mode' => modSystemEvent::MODE_NEW,
        ));
        if (is_array($this->onTVFormPrerender)) $this->onTVFormPrerender = implode('',$this->onTVFormPrerender);
    }

    /**
     * Invoke OnTVFormRender event
     * @return string
     */
    public function fireRenderEvent() {
        $this->onTVFormRender = $this->modx->invokeEvent('OnTVFormRender',array(
            'id' => $this->tvArray['id'],
            'tv' => &$this->tv,
            'mode' => modSystemEvent::MODE_NEW,
        ));
        if (is_array($this->onTVFormRender)) $this->onTVFormRender = implode('',$this->onTVFormRender);
        $this->onTVFormRender = str_replace(array('"',"\n","\r"),array('\"','',''),$this->onTVFormRender);
        return $this->onTVFormRender;
    }

    /**
     * Return the pagetitle
     *
     * @return string
     */
    public function getPageTitle() {
        return $this->modx->lexicon('tv').': '.$this->tvArray['name'];
    }

    /**
     * Return the location of the template file
     * @return string
     */
    public function getTemplateFile() {
        return 'element/tv/update.tpl';
    }

    /**
     * Specify the language topics to load
     * @return array
     */
    public function getLanguageTopics() {
        return array('tv','category','tv_widget','propertyset','element');
    }
}