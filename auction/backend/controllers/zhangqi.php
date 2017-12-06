<?php 

张琦😆☘ 2017/11/30 14:12:31
    /**
     *  媒资库影片管理-删除影片
     *  @version  v1.0.0
     *  @author   zhangqi
     *  @since    17-11-21
     */
    public function del()
    {
        $id = $this->input->post('id',TRUE);                                            // 影片的唯一标识
        empty($id) && $this->response(201,'参数错误');
        $where = ['film_id'=> $id,'status' => 0];                                       // 修改的条件
        $set   = ['status' => 1];                                                       // 要修改的状态
        $this->MediaFilmBasics->startTrans();                                           // 开启事务
        $this->MediaFilmBasics->update($where,$set);                                    // 假删除影片数据
        $this->MediaFilmExtras->update($where,$set);                                    // 删除影片扩展数据
        $this->MediaFilmPhotos->update($where,$set);                                    // 删除影片照片数据
        $this->MediaFilmVideos->update($where,$set);                                    // 删除影片视频数据
        $this->MediaFilmPrizes->update($where,$set);                                    // 删除影片获奖数据
        if($this->MediaFilmBasics->statusTrans() == FALSE)
        {
            $this->MediaFilmBasics->rollback();
            $this->response(202,'操作失败');
        }
        $this->MediaFilmBasics->commit();
        $this->response(200,"Successful");
    }

    // 公司的签名验证方法
    function generateSign($params, $key = "") {
        ksort($params);
        $stringToBeSigned = http_build_query($params) . $key;
        $sign = md5($stringToBeSigned);
        return $sign;
    }

 ?>
// 初始化一个 cURL 对象  
// $curl = curl_init();  // 设置你需要抓取的URL  
// curl_setopt($curl, CURLOPT_URL, "http://127.0.0.1/auction/backend/web/index.php?r=login/login");  // 设置header  
// curl_setopt($curl, CURLOPT_HEADER, ['username'=>$username]);  // 设置cURL 参数，要求结果(1保存到字符串中)还是(0输出到屏幕上)。  
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 运行cURL，请求网页  
// $html = curl_exec($curl);  // 关闭URL请求  
// return $html;
// curl_close($curl);

