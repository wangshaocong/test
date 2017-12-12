<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
header("content-type:text/html;charset=utf8");
class ReportController extends CommonController{
	public $enableCsrfValidation = false;
    public $layout = false;

    //渲染界面
    public function actionIndex(){
    	return $this->render('index');
    }

    //调用接口
    public function actionUpreport(){
    	if($_POST){
    		$param = yii::$app->request->post();
    		$damage_info = $param['damage_info'];
			$damage_info_json = json_decode($damage_info,true);
			$demo = [];
			foreach($damage_info_json as $k => $v){
				$demo = $v;
			}
			// print_r($demo); die;
            $param = array(
            	/**
            	 车辆损伤表  au_car_damage
            	 */
                 'position'=>$demo['position'],
                 'cus_pos_name'=>$demo['cus_pos_name'],
                 'degree'=>'1',
                 'createtime'=>'1',
                 'updatetime'=>'1',
                 /**
                  车辆损伤图片表  au_car_damage_pics
                  */
                 // 'dm_id'=>'1',
                 'url'=>$demo['urls'],
                 'visible'=>$demo['visible_type'],
                 'dm_degree'=>$demo['dm_degree'],
                 'describe'=>$demo['describe'],
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
                 'reserce_time'=>'1',
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
                 'updatetime'=>'1',
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
                 'protocol_pic'=>'1',
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
                  版本库表   au_version
                  */
                 'create_time'=>'1',
                 'update_time'=>'1',
                 'version'=>'1',
                 'link'=>'1',
                 'message'=>'1',
                 'name'=>'1',
                 'sort'=>'1',
                 'driver'=>'1',
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
    		$this->ReportUpload($param);
    	}
    }
   /**
      上传文字接口
    */
   	function ReportUpload($param){
   		//添加车源信息表
   		$au_cars = $this->getTables('au_cars',$param);
   		$au_cars_table = yii::$app->db->createCommand()->insert('au_cars',$au_cars)->execute();
   		$car_id = Yii::$app->db->getLastInsertID();
   		//添加车主线索表
   		$au_car_owner = $this->getTables('au_car_owner',$param);
   		$au_car_owner['car_id'] = $car_id;
   		$au_car_owner_table = yii::$app->db->createCommand()->insert('au_car_owner',$au_car_owner)->execute();
   		//添加车辆损伤表
   		$au_car_damage = $this->getTables('au_car_damage',$param);
   		$au_car_damage['car_id'] = $car_id;
   		// print_r($au_car_damage);die;
   		$au_car_damage_table = yii::$app->db->createCommand()->insert('au_car_damage',$au_car_damage)->execute();
   		$dm_id = Yii::$app->db->getLastInsertID();
   		//添加车辆损伤图片表
   		$au_car_damage_pics = $this->getTables('au_car_damage_pics',$param);
   		$au_car_damage_pics['dm_id'] = $dm_id;
   		$au_car_damage_pics['car_id'] = $car_id;
   		$au_car_damage_pics_table = yii::$app->db->createCommand()->insert('au_car_damage_pics',$au_car_damage_pics)->execute();
   		//添加基本照片表
   		$au_car_pictures = $this->getTables('au_car_pictures',$param);
   		$au_car_pictures['car_id']=$car_id;
   		$au_car_pictures_table = yii::$app->db->createCommand()->insert('au_car_pictures',$au_car_pictures)->execute();
   		//添加相关票证表
   		$au_car_procedure = $this->getTables('au_car_procedure',$param);
   		$au_car_procedure['car_id'] = $car_id;
   		$au_car_procedure_table = yii::$app->db->createCommand()->insert('au_car_procedure',$au_car_procedure)->execute();
   		//添加历史修复表
   		$au_car_repair_info = $this->getTables('au_car_repair_info',$param);
   		$au_car_repair_info['car_id'] = $car_id;
   		$au_car_repair_info_table = yii::$app->db->createCommand()->insert('au_car_repair_info',$au_car_repair_info)->execute();
   		//添加配置信息表
   		$au_carconfig = $this->getTables('au_carconfig',$param);
   		$au_carconfig['car_id'] = $car_id;
   		$au_carconfig_table = yii::$app->db->createCommand()->insert('au_carconfig',$au_carconfig)->execute();
   		//添加工况表
   		$au_car_perform = $this->getTables('au_car_perform',$param);
   		$au_car_perform['car_id'] = $car_id;
   		$au_car_perform_table = yii::$app->db->createCommand()->insert('au_car_perform',$au_car_perform)->execute();
   		
   		//添加版本更新表
   		$au_version = $this->getTables('au_version',$param);
   		$au_version_table = yii::$app->db->createCommand()->insert('au_version',$au_version)->execute();
        if($au_car_owner_table&&$au_car_damage_table&&$au_car_damage_pics_table&&$au_car_procedure_table&&$au_car_repair_info_table&&$au_carconfig_table&&$au_cars_table&&$au_version_table&&$au_car_perform_table){
            //成功返回json数据提示
            echo  json_encode(array('code'=>200,'msg'=>'提交成功'),JSON_UNESCAPED_UNICODE);
        }else{
			//成功返回json数据提示
	        echo  json_encode(array('code'=>201,'msg'=>'提交错误'),JSON_UNESCAPED_UNICODE);
        }
   	}

   	function getTables($tablename,$param){
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
