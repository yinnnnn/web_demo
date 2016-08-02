Date.prototype.format = function(format){
  var o = {
  "M+" : this.getMonth()+1, //month
  "d+" : this.getDate(), //day
  "h+" : this.getHours(), //hour
  "m+" : this.getMinutes(), //minute
  "s+" : this.getSeconds(), //second
  "q+" : Math.floor((this.getMonth()+3)/3), //quarter
  "S" : this.getMilliseconds() //millisecond
  }
  if(/(y+)/.test(format)) {
    format = format.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));
  }
  for(var k in o) {
    if(new RegExp("("+ k +")").test(format)) {
      format = format.replace(RegExp.$1, RegExp.$1.length==1 ? o[k] : ("00"+ o[k]).substr((""+ o[k]).length));
    }
  }
  return format;
}

Number.prototype.toNormal = function () {
  return this / 10000000;
}

String.prototype.toNormalNumber = function () {
  let val = parseFloat(this);
  return val.toNormal();
}

String.prototype.toDate = function (format) {
  let val = 0;
  if (this.length < 13) {
    val = parseInt(this) * 1000;
  } else {
    val = parseInt(this);
  }
  let date = new Date(val);
  return date.format(format);
}
const test = () => {

}

export default {
  test
}