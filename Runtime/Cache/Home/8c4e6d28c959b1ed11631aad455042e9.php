<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/Public/static/layui/css/layui.css" media="all" />
    <style>
        .layui-form-select{
            width: 80%;     //调整select的宽度
        }
    </style>
</head>
<body>
<div style="margin: 15px;">

    <form class="layui-form">

        <div class="layui-form-item">
            <label class="layui-form-label">账号</label>
            <div class="layui-input-block">
                <input type="text" name="account" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" style="width:80%;"  value="<?php echo ((isset($sysuser["account"]) && ($sysuser["account"] !== ""))?($sysuser["account"]):''); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">姓名</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" style="width:80%;" value="<?php echo ((isset($sysuser["name"]) && ($sysuser["name"] !== ""))?($sysuser["name"]):''); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">性别</label>
            <div class="layui-input-block">
                    <input type="radio" name="sex" value="1" title="男" >
                    <input type="radio" name="sex" value="0" title="女" checked="">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">手机号</label>
            <div class="layui-input-block">
                <input type="text" name="phone" lay-verify="phone" autocomplete="off" placeholder="" class="layui-input" style="width:80%;" value="<?php echo ((isset($sysuser["phone"]) && ($sysuser["phone"] !== ""))?($sysuser["phone"]):''); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
                <input type="text" name="email" lay-verify="email" autocomplete="off" placeholder="" class="layui-input" style="width:80%;" value="<?php echo ((isset($sysuser["email"]) && ($sysuser["email"] !== ""))?($sysuser["email"]):''); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">角色</label>
            <div class="layui-input-block">
                <select name="role" lay-verify="required" id="roleSelect">
                    <option value="" ></option>
                    <?php if(is_array($roles)): foreach($roles as $key=>$vo): if(($vo["id"]) == $sysuser["role"]): ?><option value="<?php echo ($vo["id"]); ?>"  selected><?php echo ($vo["title"]); ?></option>
                            <?php else: ?>
                            <option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></option><?php endif; endforeach; endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否启用</label>
            <div class="layui-input-block">
                    <input name="status" lay-skin="switch" lay-text="启用|禁用" type="checkbox">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">所属学院</label>
            <div class="layui-input-block">
                <select name="dept_id" lay-verify="required" id="deptSelect">
                    <option value="" ></option>
                    <?php if(is_array($depts)): foreach($depts as $key=>$vo): if(($vo["id"]) == $sysuser["dept_id"]): ?><option value="<?php echo ($vo["id"]); ?>"  selected><?php echo ($vo["name"]); ?></option>
                            <?php else: ?>
                            <option value="<?php echo ($vo["id"]); ?>"  ><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-block">
                <input type="text" name="remarks" maxlength="25" lay-verify="name" autocomplete="off" placeholder="最多25字" class="layui-input" style="width:80%;" value="<?php echo ((isset($sysuser["remarks"]) && ($sysuser["remarks"] !== ""))?($sysuser["remarks"]):''); ?>">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="demo1">保存</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>

    </form>
</div>
</body>
        <script src="/Public/static/layui/layui.js"></script>
<script type="text/javascript">
    var editurl = "<?php echo U('Home/SysuserManage/addSysUserByjson');?>";
    var rooturl = "/";
</script>
<script type="text/javascript" src="/Public/static/js/editSysUser.js"></script>
</html>