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

//转换成日期格式显示
Number.prototype.toDate = function (format) {
  let val = this.toString();
  return val.toDate(format);
}
/*
* 转换成金额显示，千分位逗号分隔
＊ @number @位数单位  例：以万为单位，传入5
*/
Number.prototype.toAmount = function (number) {
  let val = this.toString();
  return val.toAmount(number);
}

/*
* 转换成金额显示，千分位逗号分隔
＊ @number { Number } 位数单位  例：以万为单位，传入5
*/
String.prototype.toAmount =  function (number) {
  let val = parseFloat(this) / Math.pow(10, 6);
  if ( number && number > 0) {
    val = val / Math.pow(10, number - 1);
  }
  val = val.toFixed(2);
  return val.replace(/\d{1,3}(?=(\d{3})+(\.\d*)?$)/g, '$&,');
}

/*
* 数据存入object类型，根据对象属性排序
* @number { String } 属性名称
* @desc { Boolean } 是否降序
*/
Array.prototype.sortAttr = function (name, desc) {
  if (!name) return this;
  if (desc) {
    for (let i = 0; i < this.length - 1; i++) {
      for(let j = 0; j <  this.length - i - 1; j++) {
        if (this[j][name] < this[j+1][name]) {
          let t = this[j]
          this[j] = this[j+1];
          this[j+1] = t;
        } 
      }
    }
  } else  {
    for (let i = 0; i < this.length - 1; i++) {
      for(let j = 0; j <  this.length - i - 1; j++) {
        if (this[j][name] > this[j+1][name]) {
          let t = this[j]
          this[j] = this[j+1];
          this[j+1] = t;
        } 
      }
    }
  }
  return this;
}