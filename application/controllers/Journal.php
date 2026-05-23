<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Journal_model');
    }

    public function index()
    {
        $data['journals'] = $this->Journal_model->get_published();
        $data['page']     = 'journal';
        $data['title']    = 'Journal — Nuansa Rindu';
        $this->render('journal/index', $data);
    }

    public function detail($slug)
    {
        $journal = $this->Journal_model->get_by_slug($slug);
        if ( ! $journal) show_404();

        $data['journal'] = $journal;
        $data['recents'] = $this->Journal_model->get_published(3);
        $data['page']    = 'journal';
        $data['title']   = $journal->title . ' — Nuansa Rindu';
        $this->render('journal/detail', $data);
    }
}
