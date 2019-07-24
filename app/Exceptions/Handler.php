<?php
namespace App\Exceptions; use App\Library\Response; use Exception; use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler; use Illuminate\Support\Facades\Log; class Handler extends ExceptionHandler { protected $dontReport = array(); protected $dontFlash = array('password', 'password_confirmation'); public function report(Exception $sp63140d) { parent::report($sp63140d); } private function msg($sp0aae4c, $spb1b16a, $sp2e8268) { return $sp0aae4c->isXmlHttpRequest() ? response()->json(array('message' => $spb1b16a), $sp2e8268) : response()->view('errors._', array('code' => $sp2e8268, 'message' => $spb1b16a), $sp2e8268); } public function render($sp0aae4c, Exception $spb62437) { if ($spb62437 instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) { return $this->msg($sp0aae4c, '记录未找到', 404); } elseif ($spb62437 instanceof \Illuminate\Auth\AuthenticationException) { return $this->msg($sp0aae4c, '您需要登录您的账户再进行此操作', 401); } elseif ($spb62437 instanceof \Illuminate\Auth\Access\AuthorizationException) { return $this->msg($sp0aae4c, '未授权的操作', 403); } elseif ($spb62437 instanceof \Illuminate\Validation\ValidationException) { return parent::render($sp0aae4c, $spb62437); } elseif ($spb62437 instanceof \Illuminate\Session\TokenMismatchException) { return $this->msg($sp0aae4c, '请刷新页面后重试', 403); } elseif ($spb62437 instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) { return $this->msg($sp0aae4c, '页面未找到', 404); } elseif ($spb62437 instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) { return $this->msg($sp0aae4c, '请求方法不允许', 405); } elseif ($spb62437 instanceof \Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException) { Log::error('Caught a ServiceUnavailableHttpException', array('Exception' => $spb62437)); return $this->msg($sp0aae4c, '当前服务不可用，请稍后重试', 503); } elseif ($spb62437 instanceof \Symfony\Component\HttpKernel\Exception\HttpException) { $sp1fd4ed = $sp0aae4c->isXmlHttpRequest(); switch ($sp1fd4ed) { case 429: return $this->msg($sp0aae4c, '您的请求过于频繁，请稍后重试', $sp1fd4ed); break; default: Log::error('Caught a UnknownHttpException', array('Exception' => $spb62437)); return $this->msg($sp0aae4c, '当前服务不可用，请稍后重试', $sp1fd4ed); } } Log::error('Uncaught Exception', array('Exception' => $spb62437)); if (config('app.debug')) { return parent::render($sp0aae4c, $spb62437); } else { return $this->msg($sp0aae4c, '未知错误，请查看错误日志（storage/logs）', 500); } } }