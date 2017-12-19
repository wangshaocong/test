<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"><meta charset="utf-8">
            </head><body><h1>接口测试</h1>
            <hr>
            <b>1,拍卖系统登录接口</b>
            <form action="?r=auction/login" method="post" target="_self">
            username:<input name="username" value="真真">               <br>
            password:<input name="password" value="111" type="password">     <br>
            imei:    <input name="imei" value="359712060607931" type="text">        <br>
            <input name="submit" value="submit" type="submit">
            </form>

            <b>2,已完成列表接口</b>
            <form action="?r=auction/complete" method="post" target="_self">
                <br>员工ID:<input name="emp_id" value="198">
                <br>令牌:<input size="150" name="token" value="MDAwMDAwMDAwMH2hdrGxzWOxsIdjq4GpdN2zip_bsKXSrYBiap2IrbbgiWmKarHRgaG9eH2hga2I3cB6fsm9uLGdgJx2sYGtupl9e4-mvJaBpg">
                <br>车系ID:<input name="series_id" value="2704">
                <br>审核状态:<input name="car_status" value="1"> 1 待审核（即已导入）2 审核失败
                <br>检测开始时间:<input name="starttime" value="2012-09-28 00:00:00">
                <br>检测结束时间:<input name="endtime" value="2016-10-28 00:00:00">
                <br>currentPage:<input name="currentPage" value="1">
                <br>pageSize:<input name="pageSize" value="20">
                <br><input name="submit" value="submit" type="submit">
            </form>

            <b>4,检查App版本接口</b>
            <form action="?r=auction/versionupdate" method="post" target="_self">
            sort:<input name="sort" value="1">               <br>
            driver:<input name="driver" value="1">     <br>
            version:    <input name="version" value="1.1" type="text">        <br>
            <input name="submit" value="submit" type="submit">
            </form>

            <b>5,检查失败接口</b>
            <form action="?r=check/checkfail" method="post" target="_self">
                <br>员工ID:<input name="emp_id" value="198">
                <br>令牌:<input size="150" name="token" value="MDAwMDAwMDAwMH2hdrGxzWOxsIdjq4GpdN2zip_bsKXSrYBiap2IrbbgiWmKarHRgaG9eH2hga2I3cB6fsm9uLGdgJx2sYGtupl9e4-mvJaBpg">
                <br>车主ID:<input name="owner_id">
                <br>检测失败原因:<textarea name="remark"></textarea>
                <input name="submit" value="submit" type="submit">
            </form>

            <b>6,获取待检测接口</b>
            <form action="?r=check/waitcheck" method="post" target="_self">
                <br>员工ID:<input name="emp_id" value="198">
                <br>令牌:<input size="150" name="token" value="MDAwMDAwMDAwMH2hdrGxzWOxsIdjq4GpdN2zip_bsKXSrYBiap2IrbbgiWmKarHRgaG9eH2hga2I3cB6fsm9uLGdgJx2sYGtupl9e4-mvJaBpg">
                <input name="submit" value="submit" type="submit">
            </form>

            <b>7,审核中</b>
            <form action="?r=audit/auditing" method="post" target="_self">
                <br>员工ID:<input name="emp_id" value="198">
                <br>令牌:<input size="150" name="token" value="MDAwMDAwMDAwMH2hdrGxzWOxsIdjq4GpdN2zip_bsKXSrYBiap2IrbbgiWmKarHRgaG9eH2hga2I3cB6fsm9uLGdgJx2sYGtupl9e4-mvJaBpg">
                <input name="submit" value="submit" type="submit">
            </form>

            <b>8,审核驳回</b>
            <form action="?r=audit/auditfail" method="post" target="_self">
                <br>员工ID:<input name="emp_id" value="198">
                <br>令牌:<input size="150" name="token" value="MDAwMDAwMDAwMH2hdrGxzWOxsIdjq4GpdN2zip_bsKXSrYBiap2IrbbgiWmKarHRgaG9eH2hga2I3cB6fsm9uLGdgJx2sYGtupl9e4-mvJaBpg">
            <input name="submit" value="submit" type="submit">
            </form>

            <b>10,图处上传接口</b>
            <form action="?r=upload/imgupload" method="post"  enctype="MULTIPART/FORM-DATA" target="_self">
                <br>员工ID:<input name="emp_id" value="1">
                <br>令牌:<input size="150" name="token" value="dsE4RKT\/J77YZWWztQ7DHjAwNGZmNmU5MDQzMWE2ZDJjYTQ0ZDBjMjU2NDVlYjY5ZGI2NGI0MDdkN2VhNGE5MGJlYmMwMWNjZjQ5YWE3ODMQNENcRswRL6UJoiNgWi5SCFLSiuJUnV9S2\/+m535vhInJt91Zj8cBpxw9ynBMJOwELBcDrzfG48\/RPCXpBQEu">
                <br>图片:<input name="file" type="file">
                <input name="submit" value="submit" type="submit">
            </form>

            <hr>

            <b>11,文字上传接口</b>
            <form action="?r=report/upreport" method="post" target="_self" enctype="MULTIPART/FORM-DATA">
                <br>员工ID:<input name="emp_id" value="198">
                <br>令牌:<input size="150" name="token" value="MDAwMDAwMDAwMH2hdrGxzWOxsIdjq4GpdN2zip_bsKXSrYBiap2IrbbgiWmKarHRgaG9eH2hga2I3cB6fsm9uLGdgJx2sYGtupl9e4-mvJaBpg">
                <br>damage_info:<textarea name="damage_info" rows="5" cols="80">[{"cus_pos_name":"左前门内饰","describe":"脏污","urls":["http://clcw.oss-cn-beijing.aliyuncs.com/2015-11-09/fce2/e4c1/78be61b6-3652-781d-dbbc-a730cc0c6bc8.jpg"],"dm_degree":2,"position":1,"visible_type":1},{"cus_pos_name":"1","describe":"1","urls":["http://clcw.oss-cn-beijing.aliyuncs.com/2015-11-09/c505/c2d6/95479acc-eed6-dbf6-698b-439eae90c5e6.jpg"],"dm_degree":2,"position":21,"visible_type":1},{"cus_pos_name":"左前翼子板","describe":"划伤","urls":["http://clcw.oss-cn-beijing.aliyuncs.com/2015-11-09/2138/4949/eb5c9a1d-589a-8e40-12e3-777c10c1e79c.jpg"],"dm_degree":2,"position":22,"visible_type":2},{"cus_pos_name":"2","describe":"2","urls":["http://clcw.oss-cn-beijing.aliyuncs.com/2015-11-09/b7d2/2877/801e9ca5-41c7-acb4-a406-2b4b2e7c7fa4.jpg"],"dm_degree":2,"position":70,"visible_type":2},{"cus_pos_name":"水箱支架","describe":"裂痕","urls":["http://clcw.oss-cn-beijing.aliyuncs.com/2015-11-09/dc00/a7eb/5eed4c3f-761c-fec8-4c64-50e1c0cfde8c.jpg"],"dm_degree":2,"position":71,"visible_type":3},{"cus_pos_name":"左A柱","describe":"凹陷","urls":["http://clcw.oss-cn-beijing.aliyuncs.com/2015-11-09/2116/88f2/62fb266e-95dc-2cd8-f570-d4bc0ec09742.jpg"],"dm_degree":3,"position":78,"visible_type":3},{"cus_pos_name":"4","describe":"4","urls":["http://clcw.oss-cn-beijing.aliyuncs.com/2015-11-09/3cbc/dfa3/fbccc9d2-865b-0322-64e1-0b80592f0402.jpg"],"dm_degree":4,"position":94,"visible_type":3},{"cus_pos_name":"3","describe":"3","urls":["http://clcw.oss-cn-beijing.aliyuncs.com/2015-11-09/c51b/66e0/9e6a8866-08e3-fce6-f2a9-d78c47a47f95.jpg"],"dm_degree":3,"position":95,"visible_type":3}]</textarea>
                <input name="submit" value="submit" type="submit">
            </form>

            <hr>

            <b>12,车辆详情接口</b>
            <form action="?r=auction/carmsg" method="post" target="_self" enctype="MULTIPART/FORM-DATA">
                <br>员工ID:<input name="emp_id" value="198">
                <br>令牌:<input size="150" name="token" value="MDAwMDAwMDAwMH2hdrGxzWOxsIdjq4GpdN2zip_bsKXSrYBiap2IrbbgiWmKarHRgaG9eH2hga2I3cB6fsm9uLGdgJx2sYGtupl9e4-mvJaBpg">
                <br>车辆ID:<input name="car_id" value="1507">
                <input name="submit" value="submit" type="submit">
            </form>

    </body></html>