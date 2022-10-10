<?php
require_once('../models/gericht.php');
require_once('../models/kategorie.php');


class ExampleController
{
    public function m4_6a_queryparameter(RequestData $rd) {

        $vars = [
            'name' => $rd->query['name'] ?? 'Dummy',
            'rd' => $rd
        ];
        return view('examples.m4_6a_queryparameter',$vars);
    }
    public function m4_6b_kategorie(){
        $data = db_kategorie_sortiert();
        return view('examples.m4_6b_kategorie',['data'=>$data]);
    }

    public function m4_6c_gerichte(){
        require_once('../models/gericht.php');
        $data = db_gericht_t2();
        $empty = check_if_gericht_empty();
        return view('examples.m4_6c_gerichte',['data'=>$data,'empty'=>$empty]);
    }

    public function m4_6d_page(RequestData $rd){
        $vars =[
            'title' => $rd->query['title'] ?? 'Dummy',
            'rd' => $rd
        ];
        if(empty($rd->query['no']))
            return view('examples.pages.m4_6d_page_1',$vars);
        else if($rd->query['no']=='1')
            return view('examples.pages.m4_6d_page_1',$vars);
        else if($rd->query['no']=='2')
            return view('examples.pages.m4_6d_page_2',$vars);
    }
}