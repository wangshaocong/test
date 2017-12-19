<?php
namespace backend\models;

use yii;
use yii\base\Model;

class report extends Model{
    /**
    上传文字接口
     */
    function ReportUpload($demo){
        //添加车源信息表
        $car_id = $this->insert('au_cars',$this->param());
        //多条插入
        foreach($demo as $k => $v){
            //损伤表
            $sql = "insert into `au_car_damage` (car_id,`position`,createtime,updatetime) VALUES ('".$car_id."','".$v['position']."','456564458','".time()."') ";
            $au_car_damage = yii::$app->db->createCommand($sql)->execute();
            if ($au_car_damage) {
                $dm_id = Yii::$app->db->getLastInsertID();
            } else {
                $data  = [
                    'code' => '202',
                    'msg'=> 'error',
                    'data'=> '损伤表插入失败',
                ];
                //返回json数据提示
                return  json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            //损伤图片表
            $sql1 = "insert into `au_car_damage_pics` (car_id,dm_id,urls,visible_type,`describe`,createtime,updatetime) VALUES ('".$car_id."','".$dm_id."','".$v['urls']."','".$v['visible_type']."','".$v['describe']."','456132123','".time()."')";
            $au_car_damage_pics = yii::$app->db->createCommand($sql1)->execute();
            if (!$au_car_damage_pics) {
                $data  = [
                    'code' => '203',
                    'msg'=> 'error',
                    'data'=> '损伤图片表插入失败',
                ];
                //返回json数据提示
                return  json_encode($data,JSON_UNESCAPED_UNICODE);
            }
        }
        //添加车主线索表
        $au_car_owner = $this->insert('au_car_owner',$this->param(),$car_id);

//        //添加车辆损伤表
//        $dm_id = $this->insert('au_car_damage',$param,$car_id);
//
//        //添加车辆损伤图片表
//        $au_car_damage_pics = $this->insert('au_car_damage_pics',$param,$car_id,$dm_id);

        //添加基本照片表
        $au_car_pictures = $this->insert('au_car_pictures',$this->param(),$car_id);

        //添加隐形损伤表
        $au_hidden_injure = $this->insert('au_hidden_injure',$this->param(),$car_id);

        //添加相关票证表
        $au_car_procedure = $this->insert('au_car_procedure',$this->param(),$car_id);

        //添加历史修复表
        $au_car_repair_info = $this->insert('au_car_repair_info',$this->param(),$car_id);

        //添加配置信息表
        $au_carconfig = $this->insert('au_carconfig',$this->param(),$car_id);

        //添加工况表
        $au_car_perform = $this->insert('au_car_perform',$this->param(),$car_id);

        if(!is_array($car_id) && !is_array($au_car_owner) && !is_array($au_car_pictures) && !is_array($au_hidden_injure) && !is_array($au_car_procedure) && !is_array($au_car_repair_info) && !is_array($au_carconfig) && !is_array($au_car_perform)){
            //查询owner_id
            $owner = yii::$app->db->createCommand("select * from `au_car_owner` where car_id = '$car_id'")->queryOne();
            $au_cars = yii::$app->db->createCommand("select * from `au_cars` where car_id = '$car_id'")->queryOne();
            $data  = [
                'code' => '200',
                'msg'=> 'success',
                'data'=> [
                    'car_id'=>$car_id,
                    'car_no'=>$au_cars['car_no'],
                    'owner_id'=>$owner['owner_id'],
                ],
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            $data  = [
                'code' => '201',
                'msg'=> 'error',
                'data'=> '提交失败',
            ];
            //成功返回json数据提示
            return  json_encode($data,JSON_UNESCAPED_UNICODE);
        }
    }
    //封装插入方法
    public function insert($tablename,$data,$car_id=''){
        $table = $this->getTables($tablename,$data);
        $table['car_id'] = $car_id;
        $res = yii::$app->db->createCommand()->insert($tablename,$table)->execute();
        if ($res) {
            return Yii::$app->db->getLastInsertID();
        } else {
            $data  = [
                'code' => '201',
                'msg'=> 'error',
                'data'=> $tablename.'插入失败',
            ];
            //成功返回json数据提示
            return  json_encode($data,JSON_UNESCAPED_UNICODE);
        }
    }
    //获取表信息
    public function getTables($tablename,$param){
        $a = Yii::$app->db->schema->getTableSchema($tablename);
        $arr = (array)$a;
        $text = [];
        foreach($arr['columns'] as $key => $val){
            $text[] = $key;
        }
        foreach($param as $k => $v){
            if(in_array($k,$text)){
                $tables[$k] = $v;
            }
        }
        return $tables;
    }

	public function param(){
	    $time = time();
		$param = array(
                 /**
                  隐形损伤表   au_hidden_injure
                  */
                 'l_f_wing_board'=>'1',
                 'l_f_door'=>'1',
                 'l_b_door'=>'1',
                 'l_b_board'=>'1',
                 'trunk_cover'=>'1',
                 'r_b_board'=>'1',
                 'r_b_door'=>'1',
                 'r_f_door'=>'1',
                 'r_f_wing_board'=>'1',
                 'engine_cover'=>'1',
                 'car_top'=>'1',
                 'l_a_bar'=>'1',
                 'l_b_bar'=>'1',
                 'l_c_bar'=>'1',
                 'r_c_bar'=>'1',
                 'r_b_bar'=>'1',
                 'r_a_bar'=>'1',
                 'cover_inner_edge'=>'1',
                 'createtime'=>'1',
                 'updatetime'=>'1',
                 /**
                  车主（线索）表   au_car_owner
                  */
                 'uid'=>'1',
                 'service_id'=>'1',
                 'checker_id'=>'1',
                 'deliver_id'=>'1',
                 'seller_name'=>'1',
                 'phone'=>'1',
                 'car_model'=>'1',
                 'brand_id'=>'1',
                 'series_id'=>'1',
                 'model_id'=>'1',
                 'business_status'=>'1',
                 'mileage'=>'1',
                 'first_reg_date'=>'1',
                 'status'=>'1',
                 'comefrom'=>'1',
                 'comefrom_url'=>'1',
                 'location_area'=>'1',
                 'first_reg_city'=>'1',
                 'service_method'=>'1',
                 'certificate_type'=>'1',
                 'certificate_number'=>'1',
                 'province'=>'1',
                 'city'=>'1',
                 'area'=>'1',
                 'address'=>'1',
                 'next_trace_time'=>'1',
                 'trace_type'=>'1',
                 'reserve_time'=>'1',
                 'reserve_store'=>'1',
                 'reserve_remark'=>'1',
                 'reserve_area'=>'1',
                 'reserve_city'=>'1',
                 'reserve_province'=>'1',
                 'reserve_address'=>'1',
                 'is_assigned'=>'1',
                 'assign_remark'=>'1',
                 'checker_name'=>'1',
                 'check_remark'=>'1',
                 'check_date'=>'1',
                 'check_fail_date'=>'1',
                 'sign_next_trace_time'=>'1',
                 'sign_service_method'=>'1',
                 'sign_reserve_time'=>'1',
                 'sign_reserve_remark'=>'1',
                 'sign_reserve_area'=>'1',
                 'sign_serve_city'=>'1',
                 'sign_reserve_province'=>'1',
                 'sign_reserve_address'=>'1',
                 'sign_reseve_store'=>'1',
                 'sign_assign_remark'=>'1',
                 'sign_deliver_name'=>'1',
                 'sign_check_result'=>'1',
                 'sign_date'=>'1',
                 'audit_remark'=>'1',
                 'is_account_send'=>'1',
                 'isou_id'=>'1',
                 'rater_id'=>'1',
                 'is_self_upload'=>'1',
                 'remark_fail'=>'1',
                 'delay_status'=>'1',
                 'check_fail_type'=>'1',
                 'reserve_reminder'=>'1',
                 'owner_type'=>'1',
                 'contact_person'=>'1',
                 'old_car_id'=>'1',
                 'posttime'=>'1',
                 'createtime'=>'1',
                 'updatetime'=>'1',
                 /**
                  基本照片表   au_car_pictures
                  */
                 'pic_key'=>'1',
                 'pic_url'=>'1',
                 'pic_desc'=>'1',
                 'createtime'=>'1',
                 'updatetime'=>$time,
                 'p_left_front45'=>'1',
                 'p_right_after45'=>'1',
                 'p_appearance_front_row'=>'1',
                 'p_appearance_back_row'=>'1',
                 'p_appearance_control'=>'1',
                 'p_instrument_panel'=>'1',
                 'p_engine_room_l'=>'1',
                 'p_engine_room_r'=>'1',
                 'p_engine_room'=>'1',
                 'p_trunk'=>'1',
                 'p_key'=>'1',
                 'p_car_top'=>'1',
                 'p_vin'=>'1',
                 'p_travel_license'=>'1',
                 'p_nameplate'=>'1',
                 /**
                  相关票证表  au_car_procedure
                  */
                 'verify_expiry'=>'1',
                 'com_insure_expiry'=>'1',
                 'com_insure_expiry_remark'=>'1',
                 'com_insure_city'=>'1',
                 'com_insure_city_remark'=>'1',
                 'car_tax_expiry'=>'1',
                 'car_tax_expiry_remark'=>'1',
                 'pur_tax_cert'=>'1',
                 'import_customs_list'=>'1',
                 'commodity_inspection_list'=>'1',
                 'maintain_man'=>'1',
                 'ill_deduc_point'=>'1',
                 'forfeit'=>'1',
                 'nameplate'=>'1',
                 'appear_change'=>'1',
                 'bak_key'=>'1',
                 'invoice'=>'1',
                 'invoice_remark'=>'1',
                 'transfer_ticket'=>'1',
                 'protocol_photo'=>'1',
                 'cat_type'=>'1',
                 'is_travel_license'=>'1',
                 'is_travel_license_pic'=>'1',
                 'travel_license_pic'=>'1',
                 'travel_license_pic2'=>'1',
                 'travel_license_pic3'=>'1',
                 'travel_license_in_charge'=>'1',
                 'is_reg_cert'=>'1',
                 'reg_cert_pic'=>'1',
                 'reg_cert_pic2'=>'1',
                 'reg_cert_pic3'=>'1',
                 'reg_cert_in_charge'=>'1',
                 'is_equal'=>'1',
                 'get_method'=>'1',
                 'remark_in_reg_cert'=>'1',
                 'brand_model'=>'1',
                 'createtime'=>'1',
                 'updatetime'=>'1',
                 /**
                  历史修复表   au_car_repair_info
                  */
                 'order_id'=>'1',
                 'vin'=>'1',
                 'componentanalyzerepairtimes'=>'1',
                 'outsideanalyzerepair'=>'1',
                 'constructanalyzerepairrecords'=>'1',
                 'lastmaintaintime'=>'1',
                 'maintaintimes'=>'1',
                 'lastrepairtime'=>'1',
                 'mileageeveryyear'=>'1',
                 'normalrepairrecords'=>'1',
                 'createtime'=>'1',
                 'updatetime'=>'1',
                 /**
                  配置信息表  au_carconfig
                  */
                 'abs'=>'1',
                 'air_sac'=>'1',
                 'turn_helper'=>'1',
                 'ele_car_window'=>'1',
                 'seat_texture'=>'1',
                 'seat_adjust'=>'1',
                 'seat_func'=>'1',
                 'air_cond'=>'1',
                 'audio'=>'1',
                 'navi'=>'1',
                 'fixed_cruise'=>'1',
                 'reverse_radar'=>'1',
                 'reverse_video'=>'1',
                 'tire_hub_texture'=>'1',
                 'inte_key'=>'1',
                 'air_window'=>'1',
                 'mirror'=>'1',
                 'dvd'=>'1',
                 'createtime'=>'1',
                 'updatetime'=>'1',
                 /**
                  车源信息表  au_cars
                  */
                 'car_no'=>'1',
                 'sid'=>'1',
                 'sno'=>'1',
                 'mbrand_id'=>'1',
                 'brand_id'=>'1',
                 'series_id'=>'1',
                 'model_id'=>'1',
                 'custom_model'=>'1',
                 'remark'=>'1',
                 'car_status'=>'1',
                 'modify_time'=>'1',
                 'posttime'=>'1',
                 'first_reg_date'=>'1',
                 'composite_state'=>'1',
                 'accident_level'=>'1',
                 'history_state'=>'1',
                 'pointer_mileage'=>'1',
                 'ex_factory_date'=>'1',
                 'reg_city'=>'1',
                 'reg_area'=>'1',
                 'emission'=>'1',
                 'car_cc'=>'1',
                 'turbo'=>'1',
                 'gearbox'=>'1',
                 'drive_method'=>'1',
                 'fuel_type'=>'1',
                 'car_color'=>'1',
                 'engine_no'=>'1',
                 'cur_use_type'=>'1',
                 'use_properties'=>'1',
                 'location_area'=>'1',
                 'transfer_limit'=>'1',
                 'vin'=>'1',
                 'plate_prefix'=>'1',
                 'plate_suffix'=>'1',
                 'au_times'=>'1',
                 'unsold_times'=>'1',
                 'bid_best_price'=>'1',
                 'suggest_max_price'=>'1',
                 'suggest_min_price'=>'1',
                 'price_emp_id'=>'1',
                 'price_time'=>'1',
                 'reserve_price'=>'1',
                 'show_reserve_price'=>'1',
                 'is_proto_uploaded'=>'1',
                 'view'=>'1',
                 'carrying_num'=>'1',
                 'tyre_type'=>'1',
                 'is_imported'=>'1',
                 'transfer_times'=>'1',
                 'brand_model'=>'1',
                 'get_method'=>'1',
                 'car_type'=>'1',
                 're_auction_type'=>'1',
                 're_auction_reason'=>'1',
                 'successs_price'=>'1',
                 'first_money'=>'1',
                 'reserve_price_history'=>'1',
                 'mot'=>'1',
                 'car_source'=>'1',
                 'peccancy'=>'1',
                 'three_in_one'=>'1',
                 'tail_money'=>'1',
                 'pay_status'=>'1',
                 'audit_emp_id'=>'1',
                 'audit_time'=>'1',
                 'damage_pics'=>'1',
                 'old_model_id'=>'1',
                 'deal_type'=>'1',
                 'fail_type'=>'1',
                 'is_dealer_breach'=>'1',
                 'is_self_receive'=>'1',
                 'self_receive_dealer_id'=>'1',
                 'self_receive_price'=>'1',
                 'delivery_mode'=>'1',
                 'is_valid'=>'1',
                 'suggest_bid_start_price'=>'1',
                 'last_transfer_time'=>'1',
                 'old_reg_province'=>'1',
                 'old_reg_city'=>'1',
                 'old_use_type'=>'1',
                 'report_tmplate_version'=>'1',
                 'is_re_check'=>'1',
                 'createtime'=>'1',
                 'updatetime'=>'1',
                 /**
                  用户登录表   au_user
                  */
                 'username'=>'1',
                 'password'=>'1',
                 'email'=>'1',
                 'login_time'=>'1',
                 /**
                  工况表   	au_car_perform
                  */
                 'starter'=>'1',
                 'steering_engine'=>'1',
                 'engine'=>'1',
                 'engine_box'=>'1',
                 'ele_sys'=>'1',
                 'tool_state'=>'1',
                 'bak_tire'=>'1',
                 'other_info'=>'1',
                 'createtime'=>'1',
                 'updatetime'=>'1',
            	);
		return $param;
	}
}