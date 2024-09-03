<?php
namespace liansu\traits;

use liansu\facade\Response;

trait TControllerDefault
{
    public function success($msg = '成功', $data = []) // 这块能不能做成一个本地化的语言模块？
    {
        if (is_array($msg)) {
            $data = $msg;
            $msg = '成功';
        }
        Response::json(\liansu\Response::SUCCESS, $msg, $data);
    }

    public function error($msg = '失败', $data = [], $stat = 1)
    {
        Response::json($stat, $msg, $data);
    }

    public function json($data)
    {
        Response::printf($data);
    }
}