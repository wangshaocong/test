<b>已完成列表接口</b>
    <form action="?r=auction/complete" method="post" target="_self">
    <br>员工ID:<input name="emp_id" value="">
    <br>令牌:<input size="150" name="token" value="">
    <br>车系ID:<input name="series_id" value="">
    <br>审核状态:<input name="car_status" value=""> 1 待审核（即已导入）2 审核失败
    <br>检测开始时间:<input name="starttime" value="">
    <br>检测结束时间:<input name="endtime" value="">
    <br>currentPage:<input name="currentPage" value="">
    <br>pageSize:<input name="pageSize" value="">
    <br><input name="submit" value="submit" type="submit">
</form>