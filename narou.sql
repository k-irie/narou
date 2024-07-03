-- 
CREATE DATABASE narou COLLATE utf8mb4_general_ci;
--

CREATE TABLE ranking (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    rtype VARCHAR(12) UNIQUE,
    json text,
    create_datetime DATETIME DEFAULT CURRENT_TIMESTAMP
);


SELECT * FROM ranking WHERE rtype = '20240703-d';


INSERT INTO ranking (rtype,json) VALUES('1234','json');

--
CREATE TABLE novel (
    title VARCHAR(100) ,    -- 追放された元聖女ですが、マジで偽聖女だったので助かりました。
    ncode VARCHAR(7) ,    -- N4520JF
    userid INT ,         -- 1433491
    writer VARCHAR(100) ,   -- てんつぶ
    story TEXT ,    -- 聖女の称号を奪われ、王子に婚約破棄を言い渡されたシャーロット。だが問題は無い、なぜなら本当に偽聖女だから。\n何食わぬ顔で神殿を出たシャーロットが、知り合った男と旅をするが――\n\nこの作品は他サイトにも掲載しています。
    biggenre INT ,       -- 1
    genre INT ,  -- 101
    gensaku VARCHAR(200) ,  -- 
    keyword VARCHAR(200) ,  -- ネトコン12 ギャグ ラブコメ コメディ ドタバタ 婚約破棄 聖女
    general_firstup DATETIME ,  -- 2024-06-28 19:27:16
    general_lastup DATETIME ,   -- 2024-06-28 19:27:16
    novel_type INT ,     -- 2
    end INT ,    -- 0
    general_all_no INT ,         -- 1
    length INT ,         -- 5707
    time INT ,   -- 12
    isstop INT ,         -- 0
    isr15 INT ,  -- 0
    isbl INT ,   -- 0
    isgl INT ,   -- 0
    iszankoku INT ,      -- 0
    istensei INT ,       -- 0
    istenni INT ,        -- 0
    global_point INT ,   -- 27380
    daily_point INT ,    -- 7316
    weekly_point INT ,   -- 25172
    monthly_point INT ,  -- 25172
    quarter_point INT ,  -- 25172
    yearly_point INT ,   -- 17654
    fav_novel_cnt INT ,  -- 1094
    impression_cnt INT ,         -- 0
    review_cnt INT ,     -- 0
    all_point INT ,      -- 25192
    all_hyoka_cnt INT ,  -- 2841
    sasie_cnt INT ,      -- 0
    kaiwaritu INT ,      -- 31
    novelupdated_at DATETIME ,  -- 2024-07-01 19:32:00
    updated_at DATETIME ,       -- 2024-07-03 13:24:52
);
