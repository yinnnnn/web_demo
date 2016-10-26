/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var vm = new Vue({
    el: '#app',
    data: {
        isA:true,
        isB:true,
        items:[
            {
                id:1
            },
            {
                id:2
            }
        ]
    },
    methods: {
        change: function (type) {
            if (type == 1) {
                this.isA = true;
                this.isB = false;
            } else {
                this.isA = false;
                this.isB = true;
            }
        }
    }
})
