
"strict"

const ncode = 
{
    "title": "追放された元聖女ですが、マジで偽聖女だったので助かりました。",
    "ncode": "N4520JF",
    "userid": 1433491,
    "writer": "てんつぶ",
    "story": "聖女の称号を奪われ、王子に婚約破棄を言い渡されたシャーロット。だが問題は無い、なぜなら本当に偽聖女だから。\n何食わぬ顔で神殿を出たシャーロットが、知り合った男と旅をするが――\n\nこの作品は他サイトにも掲載しています。",
    "biggenre": 1,
    "genre": 101,
    "gensaku": "",
    "keyword": "ネトコン12 ギャグ ラブコメ コメディ ドタバタ 婚約破棄 聖女",
    "general_firstup": "2024-06-28 19:27:16",
    "general_lastup": "2024-06-28 19:27:16",
    "novel_type": 2,
    "end": 0,
    "general_all_no": 1,
    "length": 5707,
    "time": 12,
    "isstop": 0,
    "isr15": 0,
    "isbl": 0,
    "isgl": 0,
    "iszankoku": 0,
    "istensei": 0,
    "istenni": 0,
    "global_point": 27380,
    "daily_point": 7316,
    "weekly_point": 25172,
    "monthly_point": 25172,
    "quarter_point": 25172,
    "yearly_point": 17654,
    "fav_novel_cnt": 1094,
    "impression_cnt": 0,
    "review_cnt": 0,
    "all_point": 25192,
    "all_hyoka_cnt": 2841,
    "sasie_cnt": 0,
    "kaiwaritu": 31,
    "novelupdated_at": "2024-07-01 19:32:00",
    "updated_at": "2024-07-03 13:24:52"
}

const keys = Object.keys(ncode)

// console.log("CREATE TABLE","ncode" ,"(")
// keys.forEach((key,index)=>{
//     let type 
//     switch(ncode[key].constructor.name){
//         case "Number":
//             type = "INT"
//             break
//         case "String":
//             type = "VARCHAR()"
//             break
//         default:
//             type = "TEXT"
//             break
//     }
//     console.log("  ",key,type,", \t--",type=="VARCHAR()"? ncode[key].replaceAll("\n","\\n") : ncode[key])
// })
// console.log(");")




keys.forEach((key,index)=>{
    console.log(key)
})
