<?php

namespace liansu\config;

use liansu\exception\LiansuException;
use liansu\facade\Helper;
use liansu\facade\Response;
use liansu\interfaces\IViewHandler;

class LiansuViewHandler implements IViewHandler
{
    protected $tplDir; // tpl_dir
    protected $cacheDir; // cache_dir
    protected $allowedExtensions = ['php', 'html', 'htm']; // allowed_exts
    protected $templateTranslator = null; // template_translator

    public function __construct($config = [])
    {
        $this->tplDir = get_root_dir() . '/view';
        init_dir($this->tplDir);
        $this->cacheDir = get_root_dir() . '/tmp/view';
        init_dir($this->cacheDir);

        if ($config) {
            if (!empty($config['tpl_dir'])) {
                $this->tplDir = $config['tpl_dir'];
            }
            if (!empty($config['cache_dir'])) {
                $this->cacheDir = $config['cache_dir'];
            }
            if (!empty($config['allowed_exts'])) {
                $this->allowedExtensions = $config['allowed_exts'];
            }
            if (!empty($config['template_translator'])) {
                $this->templateTranslator = $config['template_translator'];
            }
        }
    }

    public function fetch($file, $args = null): string
    {
        $tplFile = $this->getTplFile($file);
        $cacheFile = $this->getCachedFile($tplFile);
        if ($cacheFile === false) {
            $cacheFile = $this->overwriteCachedFile($tplFile);
        }

        $finalContent = file_get_contents($cacheFile);
        return $finalContent;
    }

    public function display($file, $args = null)
    {
        $finalContent = $this->fetch($file, $args);

        header('Content-Type:text/html;charset=utf-8');
        echo $finalContent;
    }

    protected function getTplFile($file)
    {
        $tplDir = $this->tplDir;
        $tplFile = $tplDir . '/' . $file;

        foreach ($this->allowedExtensions as $ext) {
            $ext = ltrim($ext, '.');
            $testTplFile = $tplFile . '.' . $ext;
            if (is_file($testTplFile)) { // 找到了
                $tplFile = $testTplFile;
                return $tplFile;
            }
        }

        // 没找到
        throw new LiansuException('Template File Not Found:' . $tplFile . '.[' . implode('|', $this->allowedExtensions) . ']');
    }

    protected function getCachedFile($tplFile)
    {
        $fileKey = md5($tplFile);
        $cacheFile = $this->cacheDir . '/' . $fileKey;
        if (!is_file($cacheFile)) {
            return false;
        }

        $tplFile_mtime = filemtime($tplFile);
        $cacheFile_mtime = filemtime($cacheFile);
        if ($tplFile_mtime >= $cacheFile_mtime) { // 缓存文件版本滞后了，不能用了
            return false;
        }

        return $cacheFile;
    }

    protected function overwriteCachedFile($tplFile)
    {
        $fileKey = md5($tplFile);
        $cacheFile = $this->cacheDir . '/' . $fileKey;

        $content = file_get_contents($tplFile);
        if (!empty($this->templateTranslator)) { // 这里预留有模板引擎的情况
        }

        file_put_contents($cacheFile, $content);

        return $cacheFile;
    }
}
