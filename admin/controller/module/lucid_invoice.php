<?php
class ControllerModuleLucidInvoice extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/lucid_invoice');

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting('lucid_invoice', $this->request->post);

			$this->cache->delete('product');

			$this->session->data['success'] = $this->language->get('lucid_text_success');

			$this->redirect(HTTPS_SERVER . 'index.php?route=extension/module&token=' . $this->session->data['token']);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');
                $this->data['text_show'] = $this->language->get('text_show');
                $this->data['text_hidden'] = $this->language->get('text_hidden');
                $this->data['text_browse'] = $this->language->get('text_browse');
                $this->data['text_clear'] = $this->language->get('text_clear');
		$this->data['invoice_logo'] = $this->language->get('invoice_logo');
		$this->data['invoice_details'] = $this->language->get('invoice_details');
                $this->data['invoice_vat'] = $this->language->get('invoice_vat');
                $this->data['invoice_footer'] = $this->language->get('invoice_footer');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

  		$this->document->breadcrumbs = array();

   		$this->document->breadcrumbs[] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=common/home&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		);

   		$this->document->breadcrumbs[] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=extension/module&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('text_module'),
      		'separator' => ' :: '
   		);

   		$this->document->breadcrumbs[] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=module/lucid_invoice&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);

		$this->data['action'] = HTTPS_SERVER . 'index.php?route=module/lucid_invoice&token=' . $this->session->data['token'];

		$this->data['cancel'] = HTTPS_SERVER . 'index.php?route=extension/module&token=' . $this->session->data['token'];

		$this->data['token'] =  $this->session->data['token'];
                $this->load->model('tool/image');
                 //list stores
                $this->load->model('setting/store');
                $this->data['stores']=array();
                $this->data['stores'][0]=array('store_id'=>0,'name'=>$this->config->get('config_name'));
                 
                foreach($this->model_setting_store->getStores() as $store){
                    
                    $this->data['stores'][$store['store_id']]=array('store_id'=>$store['store_id'],'name'=>$store['name']);
                     
                    if (isset($this->request->post['lucid_invoice_logo_'.$store['store_id']])) {
                            $this->data['lucid_invoice_logo_'.$store['store_id']] = $this->request->post['lucid_invoice_logo_'.$store['store_id']];
                            $this->data['logo'] = $this->model_tool_image->resize($this->data['lucid_invoice_logo_'.$store['store_id']], 100, 100);
                    } else {
                            $this->data['lucid_invoice_logo_'.$store['store_id']] = $this->config->get('lucid_invoice_logo_'.$store['store_id']);
                            $this->data['logo'] = $this->config->get('lucid_invoice_logo_'.$store['store_id']);
                            
                    }

                    if (isset($this->request->post['lucid_invoice_details_'.$store['store_id']])) {
                            $this->data['lucid_invoice_details_'.$store['store_id']] = $this->request->post['lucid_invoice_details_'.$store['store_id']];
                    } else {
                            $this->data['lucid_invoice_details_'.$store['store_id']] = $this->config->get('lucid_invoice_details_'.$store['store_id']);
                    }

                    if (isset($this->request->post['lucid_invoice_vat_'.$store['store_id']])) {
                            $this->data['lucid_invoice_vat_'.$store['store_id']] = $this->request->post['lucid_invoice_vat_'.$store['store_id']];
                    } else {
                            $this->data['lucid_invoice_vat_'.$store['store_id']] = $this->config->get('lucid_invoice_vat_'.$store['store_id']);
                    }
                    
                    if (isset($this->request->post['lucid_invoice_footer_'.$store['store_id']])) {
                            $this->data['lucid_invoice_footer_'.$store['store_id']] = $this->request->post['lucid_invoice_footer_'.$store['store_id']];
                    } else {
                            $this->data['lucid_invoice_footer_'.$store['store_id']] = $this->config->get('lucid_invoice_footer_'.$store['store_id']);
                    }
                }
                
                if (isset($this->request->post['lucid_invoice_logo_0'])) {
                            $this->data['lucid_invoice_logo_0'] = $this->request->post['lucid_invoice_logo_0'];
                    } else {
                            $this->data['lucid_invoice_logo_0'] = $this->config->get('lucid_invoice_logo_0');
                    }

                    if (isset($this->request->post['lucid_invoice_details_0'])) {
                            $this->data['lucid_invoice_details_0'] = $this->request->post['lucid_invoice_details_0'];
                    } else {
                            $this->data['lucid_invoice_details_0'] = $this->config->get('lucid_invoice_details_0');
                    }

                    if (isset($this->request->post['lucid_invoice_vat_0'])) {
                            $this->data['lucid_invoice_vat_0'] = $this->request->post['lucid_invoice_vat_0'];
                    } else {
                            $this->data['lucid_invoice_vat_0'] = $this->config->get('lucid_invoice_vat_0');
                    }
                    
                     if (isset($this->request->post['lucid_invoice_footer_0'])) {
                            $this->data['lucid_invoice_footer_0'] = $this->request->post['lucid_invoice_footer_0'];
                    } else {
                            $this->data['lucid_invoice_footer_0'] = $this->config->get('lucid_invoice_footer_0');
                    }

		$this->template = 'module/lucid_invoice.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
                
               
                
               
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/lucid_invoice')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>