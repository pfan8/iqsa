<!--//---------------------------------+
//  Developed by dede58.com 
//  Visit http://code.dede58.com for this script and more.
//  This notice MUST stay intact for legal use
// --------------------------------->
// 屏蔽错误信息
function ResumeError() {
return true;
}
window.onerror = ResumeError;

try
{
function killErrors() {
return true;
}
window.onerror = killErrors;
}
catch(err)
{}
