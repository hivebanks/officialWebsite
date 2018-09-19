<?php
//======================================
// 函数: 员工是否有root权限
// 参数: 无
// 返回: true           有权限
//       false          无权限
// 说明:
//======================================
function has_root_pm()
{
  // Root Staff ID
  if ($_SESSION['staff_id'] == '640C3986-5EC2-EABA-59C1-B9C6EC4FF610')
    return true;
  return false;
}

//======================================
// 函数: 是否有系统权限
// 参数: $pm_list       员工拥有的权限列表
// 返回: true           有权限
//       false          无权限
// 说明:
//======================================
function has_sys_pm($pm_list)
{
  // 系统权限ID
  $pm_id = Config::SYSTEM_ID . '000';

  // 有系统权限
  if (in_array($pm_id, $pm_list))
    return true;

  // 有ROOT权限
  if (has_root_pm())
    return true;

  return false;
}

//======================================
// 函数: 员工是否有模块权限
// 参数: $pm_id         权限ID
// 参数: $pm_list       员工拥有的权限列表
// 返回: 1              有完全权限
//       0              有部分权限
//       -1             没有权限
// 说明:
//======================================
function has_sub_pm($pm_id, $pm_list)
{
  // 模块权限ID
  $sub_pm_id = substr($pm_id, 0, 3) . '0';

  // 有完全一致的权限
  if (in_array($sub_pm_id, $pm_list))
    return 1;

  // 循环员工拥有的权限列表
  foreach ($pm_list AS $pm) {
    if (substr($pm, 0, 3) . '0' == $sub_pm_id)
      return 0;
  }

  return -1;
}
?>
