//粉丝来源饼状图

function fansOrigin(data,dataOriName) {


    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('fans-origin'));

    // 指定图表的配置项和数据
    var option = {
        title: {
            show: true,
            text: 'SIEMENS粉丝来源',
            subtext: '纯属虚构',
            x: 'center'
        },
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data: dataOriName
        },
        series: [{
            name: '访问来源',
            type: 'pie',
            radius: '55%',
            center: ['50%', '60%'],
            data: data,
            //配置阴影
            itemStyle: {
                normal: {
                    // 阴影的大小
                    shadowBlur: 50,
                    // 阴影水平方向上的偏移
                    shadowOffsetX: 0,
                    // 阴影颜色
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }],
        label:{
        	normal:{
        		show:true,
        		formatter:'{b}:{c}({d}%)'
        	},
        	labelLine:{show:true}
        }
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);

}

//数据统计折线图
function dataSum(arrDatePV,arrPV,arrDateUV,arrUV,arrDateFANS,arrFANS) {

    //PV折线图
    // 基于准备好的dom，初始化echarts实例
    var myChartPV = echarts.init(document.getElementById('data-summaryPV'));
    //配置项
    var optionPV = {
        title: {
            text: '未来一周气温变化',
            subtext: '纯属虚构'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: ['PV']
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: arrDatePV,
            axisLabel:{interval:0,rotate:45}
                // ['周一', '周二', '周四', '周五', '周六']
        },
        yAxis: {
            type: 'value',
            axisLabel: {
                formatter: '{value}'
            }
        },
        series: [{
            name: 'PV',
            type: 'line',
            data: arrPV,
			itemStyle : { normal: {label : {show: true}}}
        }]
    };
    // 使用刚指定的配置项和数据显示图表。
    myChartPV.setOption(optionPV);


    //UV折线图
    // 基于准备好的dom，初始化echarts实例
    var myChartUV = echarts.init(document.getElementById('data-summaryUV'));
    //配置项
    var optionUV = {
        title: {
            text: '未来一周气温变化',
            subtext: '纯属虚构'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: ['UV']
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: arrDateUV,
            axisLabel:{interval:0,rotate:45}
                // ['周一', '周二', '周四', '周五', '周六']
        },
        yAxis: {
            type: 'value',
            axisLabel: {
                formatter: '{value}'
            }
        },
        series: [{
            name: 'UV',
            type: 'line',
            data: arrUV,
            itemStyle : { normal: {label : {show: true}}}

        }]
    };
    // 使用刚指定的配置项和数据显示图表。
    myChartUV.setOption(optionUV);



    //FANS折线图
    // 基于准备好的dom，初始化echarts实例
    var myChartFANS = echarts.init(document.getElementById('data-summaryFANS'));
    //配置项
    var optionFANS = {
        title: {
            text: '未来一周气温变化',
            subtext: '纯属虚构'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: ['FANS']
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: arrDateFANS,
            axisLabel:{interval:0,rotate:45}
                // ['周一', '周二', '周四', '周五', '周六']
        },
        yAxis: {
            type: 'value',
            axisLabel: {
                formatter: '{value}'
            }
        },
        series: [{
            name: 'FANS',
            type: 'line',
            data: arrFANS,
            itemStyle : { normal: {label : {show: true}}}

        }]
    };
    // 使用刚指定的配置项和数据显示图表。
    myChartFANS.setOption(optionFANS);


}
