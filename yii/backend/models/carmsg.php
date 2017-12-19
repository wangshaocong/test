<?php
namespace backend\models;

use yii;
use yii\base\Model;
/*
 * user: 刘林方
 * time: 2017-12-14
 * content: 车辆详情接口
 */
class carmsg extends Model{
	public function content($car_id){
        //车辆详情表
        $au_cars = $this->sql("au_cars",$car_id);
        //手续表
        $au_car_procedure = $this->sql("au_car_procedure",$car_id);
        //线索表
        $au_car_owner = $this->sql("au_car_owner",$car_id);
        //配置表
		$au_carconfig = $this->sql("au_carconfig",$car_id);
        //工况表
        $au_car_perform = $this->sql("au_car_perform",$car_id);
        //隐性损伤表
        $au_hidden_injure = $this->sql("au_hidden_injure",$car_id);
        //显性损伤表
        $au_car_damage = $this->sql("au_car_damage",$car_id);
        //损伤图片表
        $au_car_damage_pics = $this->sql("au_car_damage_pics",$car_id);
        //车辆基本照片表
        $au_car_pictures = $this->sql("au_car_pictures",$car_id);
        //组合数组
        $arr = [];
        foreach ($au_car_damage_pics as $k => $v){
            $arr[$k] = [
                'visible_type' => $v['visible_type'],
                'describe' => $v['describe'],
                'dm_degree' => $v['dm_degree'],
                'url' => $v['urls']
            ];
        }
        $arr1 = [];
        foreach ($au_car_damage as $k => $v){
            $arr1[$k] = [
                'position' => $v['position'],
                'urls' => $arr
            ];
        }
        $res = array(
            'base_info' => array(
                'brand_model' => $au_cars['brand_model'],
                'invoice' => $au_car_procedure['invoice'],
                'invoice_remark' => $au_car_procedure['invoice_remark'],
                'car_cc' => $au_cars['car_cc'],
                'turbo' => $au_cars['turbo'],
                'plate_suffix' => $au_cars['plate_suffix'],
                'carrying_num' => $au_cars['carrying_num'],
                'certificate_number' => $au_car_owner['certificate_number'],
                'air_sac' => $au_carconfig['air_sac'],
                'engine_no' => $au_cars['engine_no'],
                'first_reg_date' => $au_cars['first_reg_date'],
                'pid' => 5,
                'owner_type' => $au_car_owner['owner_type'],
                'contact_person' => $au_car_owner['contact_person'],
                'comefrom' => $au_car_owner['comefrom'],
                'address' => $au_car_owner['address'],
                'area' => $au_car_owner['area'],
                'city' => $au_car_owner['city'],
                'phone' => $au_car_owner['phone'],
                'province' => $au_car_owner['province'],
                'seller_name' => $au_car_owner['seller_name'],
                'ex_factory_date' => $au_cars['ex_factory_date'],
                'reg_city' => $au_cars['reg_city'],
                'reg_area' => $au_cars['reg_area'],
                'remark_in_reg_cert' => $au_car_procedure['remark_in_reg_cert'],
                'pointer_mileage' => $au_cars['pointer_mileage'],
                'com_insure_city' => $au_car_procedure['com_insure_city'],
                'com_insure_city_remark' => $au_car_procedure['com_insure_city_remark'],
                'com_insure_expiry' => $au_car_procedure['com_insure_expiry'],
                'com_insure_expiry_remark' => $au_car_procedure['com_insure_expiry_remark'],
                'transfer_times' => $au_cars['transfer_times'],
                'car_tax_expiry' => $au_car_procedure['car_tax_expiry'],
                'car_tax_expiry_remark' => $au_car_procedure['car_tax_expiry_remark'],
                'vin' => $au_cars['vin'],
                'forfeit' => $au_car_procedure['forfeit'],
                'ill_deduc_point' => $au_car_procedure['ill_deduc_point'],
                'tyre_type' => $au_cars['tyre_type'],
                'verify_expiry' => $au_car_procedure['verify_expiry'],
                'car_color' => $au_cars['car_color'],
                'plate_prefix' => $au_cars['plate_prefix'],
                'car_type' => $au_cars['car_type'],
                'is_equal' => $au_car_procedure['is_equal'],
                'travel_license_in_charge' => $au_car_procedure['travel_license_in_charge'],
                'reg_cert_in_charge' => $au_car_procedure['reg_cert_in_charge'],
                'certificate_type' => $au_car_owner['certificate_type'],
                'abs' => $au_carconfig['abs'],
                'air_cond' => $au_carconfig['air_cond'],
                'seat_adjust' => $au_carconfig['seat_adjust'],
                'ele_car_window' => $au_carconfig['ele_car_window'],
                'fixed_cruise' => $au_carconfig['fixed_cruise'],
                'dvd' => $au_carconfig['dvd'],
                'navi' => $au_carconfig['navi'],
                'reverse_radar' => $au_carconfig['reverse_radar'],
                'turn_helper' => $au_carconfig['turn_helper'],
                'mirror' => $au_carconfig['mirror'],
                'reverse_video' => $au_carconfig['reverse_video'],
                'seat_func' => $au_carconfig['seat_func'],
                'seat_texture' => $au_carconfig['seat_texture'],
                'air_window' => $au_carconfig['air_window'],
                'inte_key' => $au_carconfig['inte_key'],
                'audio' => $au_carconfig['audio'],
                'tire_hub_texture' =>$au_carconfig['tire_hub_texture'],
                'drive_method' => $au_cars['drive_method'],
                'emission' => $au_cars['emission'],
                'fuel_type' => $au_cars['fuel_type'],
                'gearbox' => $au_cars['gearbox'],
                'get_method' => $au_cars['get_method'],
                'appear_change' => $au_car_procedure['appear_change'],
                'pur_tax_cert' => $au_car_procedure['pur_tax_cert'],
                'nameplate' => $au_car_procedure['nameplate'],
                'commodity_inspection_list' => $au_car_procedure['commodity_inspection_list'],
                'is_travel_license' => $au_car_procedure['is_travel_license'],
                'import_customs_list' => $au_car_procedure['import_customs_list'],
                'maintain_man' => $au_car_procedure['maintain_man'],
                'is_reg_cert' => $au_car_procedure['is_reg_cert'],
                'bak_key' => $au_car_procedure['bak_key'],
                'transfer_ticket' => $au_car_procedure['transfer_ticket'],
                'is_imported' => $au_cars['is_imported'],
                'mbrand_id' => $au_cars['mbrand_id'],
                'brand_id' => $au_cars['brand_id'],
                'series_id' => $au_cars['series_id'],
                'model_id' => $au_cars['model_id'],
                'custom_model' => $au_cars['custom_model'],
                'cur_use_type' => $au_cars['cur_use_type'],
                'use_properties' => $au_cars['use_properties'],
                'old_reg_province' => $au_cars['old_reg_province'],
                'old_reg_city' => $au_cars['old_reg_city'],
                'old_use_type' => $au_cars['old_use_type']
            ),
            'common_info' =>array(
                'report_tmplate_version' => $au_cars['report_tmplate_version'],
                'history_state' => $au_cars['history_state'],
                'check_date' => $au_car_owner['check_date'],
                'accident_level' => $au_cars['accident_level'],
                'composite_state' => $au_cars['composite_state'],
                'car_id' => $au_cars['car_id'],
                'car_no' => $au_cars['car_no'],
                'sid' => $au_cars['sid'],
                'sno' => $au_cars['sno'],
                'owner_id' => $au_car_owner['owner_id'],
                'reserve_time' => $au_car_owner['reserve_time'],
                'modify_time' => $au_cars['modify_time']
            ),
            'condition_state' => array(
                'other_info' => $au_car_perform['other_info'],
                'engine' => $au_car_perform['engine'],
                'engine_box' => $au_car_perform['engine_box'],
                'bak_tire' => $au_car_perform['bak_tire'],
                'starter' => $au_car_perform['starter'],
                'steering_engine' => $au_car_perform['steering_engine'],
                'tool_state' => $au_car_perform['tool_state'],
                'ele_sys' => $au_car_perform['ele_sys']
            ),
            'hidden_injure' => array(
                'l_f_wing_board' => $au_hidden_injure['l_f_wing_board'],
                'l_f_door' => $au_hidden_injure['l_f_door'],
                'l_b_door' => $au_hidden_injure['l_b_door'],
                'l_b_wing_board' => $au_hidden_injure['l_b_wing_board'],
                'trunk_cover' => $au_hidden_injure['trunk_cover'],
                'r_b_wing_board' => $au_hidden_injure['r_b_wing_board'],
                'r_b_door' => $au_hidden_injure['r_b_door'],
                'r_f_door' => $au_hidden_injure['r_f_door'],
                'r_f_wing_board' => $au_hidden_injure['r_f_wing_board'],
                'engine_cover' => $au_hidden_injure['engine_cover'],
                'car_top' => $au_hidden_injure['car_top'],
                'l_a_bar' => $au_hidden_injure['l_a_bar'],
                'l_b_bar' => $au_hidden_injure['l_b_bar'],
                'l_c_bar' => $au_hidden_injure['l_c_bar'],
                'r_c_bar' => $au_hidden_injure['r_c_bar'],
                'r_b_bar' => $au_hidden_injure['r_b_bar'],
                'r_a_bar' => $au_hidden_injure['r_a_bar'],
                'cover_inner_edge' => $au_hidden_injure['cover_inner_edge']
            ),
            'base_photo' => array(
                'p_left_front45' => $au_car_pictures['p_left_front45'],
                'p_right_after45' => $au_car_pictures['p_right_after45'],
                'p_appearance_front_row' => $au_car_pictures['p_appearance_front_row'],
                'p_appearance_back_row' => $au_car_pictures['p_appearance_back_row'],
                'p_appearance_control' => $au_car_pictures['p_appearance_control'],
                'p_instrument_panel' => $au_car_pictures['p_instrument_panel'],
                'p_engine_room_l' => $au_car_pictures['p_engine_room_l'],
                'p_engine_room_r' => $au_car_pictures['p_engine_room_r'],
                'p_engine_room' => $au_car_pictures['p_engine_room'],
                'p_trunk' => $au_car_pictures['p_trunk'],
                'p_key' => $au_car_pictures['p_key'],
                'p_car_top' => $au_car_pictures['p_car_top'],
                'p_vin' => $au_car_pictures['p_vin'],
                'p_travel_license' => $au_car_pictures['p_travel_license'],
                'p_nameplate' => $au_car_pictures['p_nameplate'],
                'travel_license_pic' => $au_car_procedure['travel_license_pic'],
                'travel_license_pic2' => $au_car_procedure['travel_license_pic2'],
                'travel_license_pic3' => $au_car_procedure['travel_license_pic3'],
                'reg_cert_pic' => $au_car_procedure['reg_cert_pic'],
                'reg_cert_pic2' => $au_car_procedure['reg_cert_pic2'],
                'reg_cert_pic3' => $au_car_procedure['reg_cert_pic3'],
                'protocol_photo' => $au_car_procedure['protocol_photo']
            ),
            'protocol' => array(
                'transfer_limit' => $au_cars['transfer_limit'],
                'suggest_max_price' => $au_cars['suggest_max_price'],
                'suggest_min_price' => $au_cars['suggest_min_price'],
                'reserve_price' => $au_cars['reserve_price'],
                'suggest_bid_start_price' => $au_cars['suggest_bid_start_price']
            ),
            'damage_info' => $arr1,
        );
        $data = array(
            'code' => 200,
            'msg' => "success",
            'data' => $res
        );
        return $data;
	}
	//封装查询方法
	public function sql($table,$car_id){
        $sql = "select * from $table where car_id = $car_id";
        //判断表名来区别是查询单条还是查询多条
		if ($table == 'au_car_damage_pics' || $table == 'au_car_damage') {
            return Yii::$app->db->createCommand($sql)->queryAll();
        } else {
            return Yii::$app->db->createCommand($sql)->queryOne();
        }
	}
}