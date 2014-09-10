<?php

class NewslettersController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index() {
        $this->set('newsletters', $this->Newsletter->find('all'));
    } 
    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $newsletter = $this->Newsletter->findById($id);
        if (!$newsletter) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('newsletter', $newsletter);
    }
    public function add() {
        if ($this->request->is('post')) {
            $this->Newsletter->create();
            if ($this->Newsletter->save($this->request->data)) {
            	
                $this->Session->setFlash(__('Your newsletter has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your newsletter.'));
        }
    }

    public function show() {
			//$this->set('newsletters', $this->Newsletter->find('all', array('order' => array('Newsletter.Created DESC'))));
			$newsletter=$this->Newsletter->find('all', array('order' => array('Newsletter.Created DESC')));
			//pr($newsletter);exit;
			$year = array();
			$month= array();
			foreach ($newsletter as $news) {
				$post_date=$news['Newsletter']['created'];
				$yrs=explode("-",$post_date);
				$yr=$yrs[0];
				$mon=$yrs[1];
				{ 					
		          if (in_array($yr, $year)) 
		          {
		            		        		
		          }
		          else
		          {
		          	
		        	$year[$yr]=$this->create_month($yr);
		          }					      
				}
			}
			//pr($year);exit;
			$this->set('year',$year);
	 }

    public function create_month($yr)
    {
 		 $conditions['Newsletter.Created LIKE'] = $yr."%";
 		 $new=$this->Newsletter->find('all', array('conditions' => $conditions,'order' => array('Newsletter.Created DESC')));
 		 $month_list=array(
 		 	1=> 'Jan',
 		 	2=> 'Feb',
 		 	3=> 'Mar',
 		 	4=> 'Apr',
 		 	5=> 'May',
 		 	6=> 'Jun',
 		 	7=> 'Jul',
 		 	8=> 'Aug',
 		 	9=> 'Sept',
 		 	10=> 'Oct',
 		 	11=> 'Nov',
 		 	12=> 'Dec');		                                              
    	 $month= array();
    	 foreach ($new as $news) {
				$post_date=$news['Newsletter']['created'];
				$yrs=explode("-",$post_date);
				$mon=(int)$yrs[1];
				{ 					
		          if (in_array($mon, $month)) 
		          {
		            		        		
		          }
		          else
		          {
		        	$month[]=$month_list[$mon++];
		          }					      
				}		
			}	
    	return $month;
    }
    public function edit($id = null) {
	    if (!$id) {
	        throw new NotFoundException(__('Invalid newsletter'));
	    }

	    $newsletter = $this->Newsletter->findById($id);

	    if (!$newsletter) {
	        throw new NotFoundException(__('Invalid newsletter'));
	    }
	    
	    if ($this->request->is(array('post', 'put'))) {	    	
	        $this->Newsletter->id = $id;
	        echo $this->request->data['Newsletter']['title'];exit;
	        if ($this->Newsletter->save($this->request->data)) {
	            $this->Session->setFlash(__('Your newsletter has been updated.'));
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update your newsletter.'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $newsletter;
	    }
	}
	public function delete($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }

	    if ($this->Newsletter->delete($id)) {
	        $this->Session->setFlash(
	            __('The post with id: %s has been deleted.', h($id))
	        );
	        return $this->redirect(array('action' => 'index'));
	    }
	}	   
}

?>