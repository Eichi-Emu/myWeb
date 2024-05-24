'''
todo   メモ
複数ページにまたがるスクレイピングなので取得をその都度繰り返す必要がある
一覧からURLを取得してそこに「/spec」をつけて詳細を取得。それを繰り返すことで全ページを取得する。
1ページあたりの項目数は40あるのでforで40回して・・・いやこれ一個のforにして%40==0の際にページ切り替えしたほうが良い・・・？
あと取得する項目が物によって違うからそこをどうするか
DRAMのXMP、文字列操作なんて面倒なことせずとも文字列内検索で上からかけてけばいいのでは・・・？

ようぼー
ショップ固定機能(どこどこオンリーで買う際の見積もり)
独自パーツ挿入(DBに一時バッファつくるだと多分キャッシュ死ぬし情報として終わるからクエリにぶち込みたいけどURLがアホ長くなる・・・
CPUクーラーやらマザーやらの互換情報の紐づけ
URL shorty

CPU maker,name,price,gen,socket
m/b maker,name,price,chip,socket,formfact,ram,ram num,TB?,wifi?
ram maker,name,price,gen,value,pcs,hz,ecc?,RIMM?
CPUC maker,name,price,type,socket,size
GPU maker,name,price,chipMaker,chip,VRAM,cooling type?,size
ssd maker,name,price,value,interface,type(size),read and write
hdd maker,name,price,value,interface
psu maker,name,price,value,80+,formfact,plug-in
case maker,name,price,formfacta,max-height,gpu-long

メモ
～240mm未満
240mm～280mm未満
280mm～360mm未満
360mm～
こういうふうに分かれてる
'''

import re
import threading
import time
import requests
import mysql
from mysql.connector import errorcode
from bs4 import BeautifulSoup


class dosomething:

    cpu_url = []
    mb_url = []
    ram_url = []
    cpuc_url = []
    gpu_url = []
    ssd_url = []
    hdd_url = []
    psu_url = []
    case_url = []
    os_url = []

    cpu_content = [[]]
    mb_content = [[]]
    ram_content = [[]]
    cpuc_content = [[]]
    gpu_content = [[]]
    ssd_content = [[]]
    hdd_content = [[]]
    psu_content = [[]]
    case_content = [[]]
    os_content = [[]]

    url = "https://kakaku.com/pc/"
    aspx = "/itemlist.aspx"

    def scr_GetUrl(self, genre):
        num = 1
        content_url = []

        url = self.url + genre + self.aspx  #ジャンルごとのリストURLの動的生成
        res = requests.get(url)
        time.sleep(3)   #読み込み完了待機
        soup = BeautifulSoup(res.content, "lxml")

        req = soup.find(class_="result").get_text() #製品数の取得
        req = int(req.replace('製品','')) #末尾に「製品」がついているため排除し数値化
        req_sum = (req // 40 + 1) #実ページ数計算
        print(genre+":content sum>" + str(req))
        print(genre+":Page sum>" + str(req_sum))

        while num <= req_sum:   #製品詳細画面用ID取得
            content = soup.find_all(class_="ckitemLink")
            for tag in content:
                for a in tag.select('a'):
                    content_url = content_url + [a.get('href')]

            nextPage = url + "?pdf_pg=" + str(num + 1)
            res = requests.get(nextPage)
            time.sleep(1)

            soup = BeautifulSoup(res.content, "lxml")
            num = num + 1
        num = 0
        for c in content_url:
            content_url[num] = content_url[num] + "spec/"
            num = num + 1
        print(genre+":Get content sum is done")
        return content_url

    def scr_getContent(self, url, genre):
        num = 0
        content_list = []
        content_out = []
        #print("content>" + genre)
        time.sleep(10)
        for u in url:
            res = requests.get(u)
            time.sleep(1)
            soup = BeautifulSoup(res.content, "lxml")

            if genre == "cpu":
                content_list = []
                try:
                    # URL
                    content_list = content_list + [u.replace('spec/', '')]
                    # maker
                    content = soup.find(class_="digestMakerName")
                    content = content.get_text()
                    content_list = content_list + [content]

                    # name
                    content = soup.find("h2", attrs={'itemprop': 'name'})
                    content = content.get_text()
                    content = content[0:55]
                    content_list = content_list + [content]

                    # price
                    try:
                        content = soup.find(class_="priceTxt")
                        content = content.get_text()
                        content = content.replace('¥', '').replace(',', '')
                    except:
                        content = "99999999"
                    content_list = content_list + [content]

                    # gen
                    content_table = soup.find_all(id='specContents')
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[1]
                    else:
                        content = content_table[0].find_all_next("td")[1]
                    content = content.get_text()
                    content = content[0:9]
                    content_list = content_list + [content]

                    # socket
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[2]
                    else:
                        content = content_table[0].find_all_next("td")[2]
                    content = content.get_text()
                    content = content[0:14]
                    content_list = content_list + [content]

                except:
                    content = "Error"
                    content_num = '0'
                    url = u.replace('spec/', '')
                    content_list =[url] + [content] + [content] + [content_num] + [content_num] + [content_num] + [content]

            if genre == "mb":

                content_list = []
                try:
                    # URL
                    url = u.replace('spec/', '')
                    content_list = content_list + [url]
                    # maker
                    content = soup.find(class_="digestMakerName")
                    content = content.get_text()
                    content_list = content_list + [content]

                    # name
                    content = soup.find("h2", attrs={'itemprop': 'name'})
                    content = content.get_text()
                    content = content[0:55]
                    content_list = content_list + [content]

                    # price
                    try:
                        content = soup.find(class_="priceTxt")
                        content = content.get_text()
                        content = content.replace('¥', '').replace(',', '')
                    except:
                        content = "99999999"
                    content_list = content_list + [content]

                    # chipset
                    content_table = soup.find_all(id='specContents')
                    #print(len(content_table))
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[0]
                    else:
                        content = content_table[0].find_all_next("td")[0]
                    content = content.get_text()
                    content = re.sub('AMD|INTEL', '', content)
                    content = content[0:9]
                    content_list = content_list + [content]

                    # socket
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[1]
                    else:
                        content = content_table[0].find_all_next("td")[1]
                    content = content.get_text()
                    content = content[0:14]
                    content_list = content_list + [content]

                    # FA
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[2]
                    else:
                        content = content_table[0].find_all_next("td")[2]
                    content = content.get_text()
                    content = content[0:19]
                    content_list = content_list + [content]

                    # ram
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[4]
                    else:
                        content = content_table[0].find_all_next("td")[4]
                    content = content.get_text()
                    content = content[0:14]
                    content_list = content_list + [content]

                    # ram num
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[5]
                    else:
                        content = content_table[0].find_all_next("td")[5]
                    content = content.get_text()
                    content = content[0:14]
                    content_list = content_list + [content]

                    # TB
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("tr")[16].find_next("td")
                    else:
                        content = content_table[0].find_all_next("tr")[16].find_next("td")
                    content = content.get_text()

                    if re.search('Thunderbolt', content):
                        content_list = content_list + ["1"]
                    else:
                        content_list = content_list + ["0"]

                    # wifi
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("tr")[22].find_next("td")
                    else:
                        content = content_table[0].find_all_next("tr")[22].find_next("td")
                    content = content.get_text()

                    if re.search('IEEE', content):
                        content_list = content_list + ["1"]
                    else:
                        content_list = content_list + ["0"]
                except:
                    content = "Error"
                    content_num = "0"
                    url = u.replace('spec/', '')
                    content_list =[url] + [content] + [content] + [content_num] + [content] + [content] + [content] + [content] + [content] + [content_num] + [content_num]

            if genre == "ram":
                content_list = []
                try:
                    # URL
                    url = u.replace('spec/', '')
                    content_list = content_list + [url]
                    # maker
                    content = soup.find(class_="digestMakerName")
                    content = content.get_text()
                    content = content[0:29]
                    content_list = content_list + [content]

                    # name
                    content = soup.find("h2", attrs={'itemprop': 'name'})
                    content = content.get_text()
                    content = content[0:55]
                    content_list = content_list + [content]

                    # price
                    try:
                        content = soup.find(class_="priceTxt")
                        content = content.get_text()
                        content = content.replace('¥', '').replace(',', '')
                    except:
                        content = "99999999"
                    content_list = content_list + [content]

                    # gen
                    content_table = soup.find_all(id='specContents')
                    #print(len(content_table))
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[3]
                    else:
                        content = content_table[0].find_all_next("td")[3]
                    content = content.get_text()
                    content = content[0:14]
                    content_list = content_list + [content]

                    # type
                    #print(len(content_table))
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[2]
                    else:
                        content = content_table[0].find_all_next("td")[2]
                    content = content.get_text()
                    content = content[0:14]
                    content_list = content_list + [content]

                    # hz
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[5]
                    else:
                        content = content_table[0].find_all_next("td")[5]

                    text = content.get_text()
                    pattern = r"DDR5-(?:(?:52|56|58|60|62|64|68|70|72|76|80|82|84)00|4800)"

                    target = 'DDR5'
                    if target in text:
                        matches2 = re.findall(pattern, text)
                        #print(matches[-1])
                        content_list = content_list + [matches2[-1]]
                        #print("ramContentsXMPorSPD:::",content_list)
                    else:
                        target = '('
                        c = text.find(target)
                        content = text[c + 1:]
                        matches2 = content.replace(')', '')
                        content_list = content_list + [matches2]
                        #print("ramContentsXMPorSPD:::", content_list)



                    # value
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[0]
                    else:
                        content = content_table[0].find_all_next("td")[0]
                    if len(content_table) > 1:
                        temp = content_table[1].find_all_next("td")[1]
                    else:
                        temp = content_table[0].find_all_next("td")[1]

                    temp = temp.get_text()
                    content = content.get_text()
                    content = int(re.sub(r"\D", "", content))
                    temp = int(re.sub(r"\D", "", temp))
                    content = content * temp
                    content_list = content_list + [str(content)]

                    # 1pcs-value
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[0]
                    else:
                        content = content_table[0].find_all_next("td")[0]
                    content = content.get_text()
                    content = content.replace('GB', '')
                    pc = int(content)
                    content_list = content_list + [content]

                    # pcs
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[1]
                    else:
                        content = content_table[0].find_all_next("td")[1]
                    content = content.get_text()
                    content = content.replace('枚','')
                    pcs = int(content)
                    content_list = content_list + [content]

                    # ecc/Reg
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[8]
                    else:
                        content = content_table[0].find_all_next("td")[8]
                    content = content.get_text()
                    content = content.replace('ECC', '').replace('Reg', '')
                    if re.search('非対応非対応', content):
                        content_list = content_list + ["0"]
                        content_list = content_list + ["0"]
                    elif re.search('非対応対応', content):
                        content_list = content_list + ["0"]
                        content_list = content_list + ["1"]
                    elif re.search('対応非対応', content):
                        content_list = content_list + ["1"]
                        content_list = content_list + ["0"]
                    elif re.search('対応対応', content):
                        content_list = content_list + ["1"]
                        content_list = content_list + ["1"]
                    else:
                        content_list = content_list + ["0"]
                        content_list = content_list + ["0"]
                except:
                    content = "Error"
                    content_num = "0"
                    url = u.replace('spec/', '')
                    content_list = content_list =[url] + [content] + [content] + [content_num] + [content] + [content] + [content] + [content_num] + [content_num] + [content_num] + [content_num] + [content_num]

            if genre == "cpuc":
                content_list = []
                try:
                    # URL
                    url = u.replace('spec/', '')
                    content_list = content_list + [url]
                    # maker
                    content = soup.find(class_="digestMakerName")
                    content = content.get_text()
                    content_list = content_list + [content]

                    # name
                    content = soup.find("h2", attrs={'itemprop': 'name'})
                    content = content.get_text()
                    content = content[0:55]
                    content_list = content_list + [content]

                    # price
                    try:
                        content = soup.find(class_="priceTxt")
                        content = content.get_text()
                        content = content.replace('¥', '').replace(',', '')
                    except:
                        content = "99999999"
                    content_list = content_list + [content]

                    # type
                    content_table = soup.find_all(id='specContents')
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[2]
                    else:
                        content = content_table[0].find_all_next("td")[2]
                    content = content.get_text()
                    type = content
                    content = content[0:9]
                    content_list = content_list + [content]

                    # socket
                    if len(content_table) > 1:
                        content1 = content_table[1].find_all_next("td")[0]
                        content2 = content_table[1].find_all_next("td")[1]
                    else:
                        content1 = content_table[0].find_all_next("td")[0]
                        content2 = content_table[0].find_all_next("td")[1]

                    content = content1.get_text() + "/" + content2.get_text()
                    content = (content.replace('LGA', '/').replace(' ', ''))[1:]
                    content = content[0:59]
                    content_list = content_list + [content]

                    # size
                    if re.search('水冷', type):
                        if len(content_table) > 1:
                            content = content_table[1].find_all_next("td")[4]
                        else:
                            content = content_table[0].find_all_next("td")[4]
                    else:
                        if len(content_table) > 1:
                            content = content_table[1].find_all_next("td")[17]
                        else:
                            content = content_table[0].find_all_next("td")[17]

                    content = content.get_text()
                    content = content[0:19]
                    content_list = content_list + [content]

                except:
                    content = "Error"
                    content_num = "0"
                    url = u.replace('spec/', '')
                    content_list =[url] + [content] + [content] + [content_num] + [content] + [content] + [content]

            if genre == "gpu":
                content_list = []
                try:
                    # URL
                    url = u.replace('spec/', '')
                    content_list = content_list + [url]
                    # maker
                    content = soup.find(class_="digestMakerName")
                    content = content.get_text()
                    content_list = content_list + [content]

                    # name
                    content = soup.find("h2", attrs={'itemprop': 'name'})
                    content = content.get_text()
                    content = content[0:99]
                    content_list = content_list + [content]

                    # price
                    try:
                        content = soup.find(class_="priceTxt")
                        content = content.get_text()
                        content = content.replace('¥', '').replace(',', '')
                    except:
                        content = "99999999"
                    content_list = content_list + [content]

                    # chipmaker/chip
                    content_table = soup.find_all(id='specContents')
                    #print(len(content_table))
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[0]
                    else:
                        content = content_table[0].find_all_next("td")[0]
                    content = content.get_text()
                    if re.search('NVIDIA', content):
                        chipM = "NVIDIA"
                        chip = content.replace('NVIDIA', '')
                        chip = chip[0:14]
                        content_list = content_list + [chipM] + [chip]
                    elif re.search('AMD', content):
                        chipM = "AMD"
                        chip = content.replace('AMD', '')
                        chip = chip[0:14]
                        content_list = content_list + [chipM] + [chip]
                    else:
                        chipM = "INTEL"
                        chip = content.replace('Intel', '')
                        chip = chip[0:14]
                        content_list = content_list + [chipM] + [chip]

                    # VRAM
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[1]
                    else:
                        content = content_table[0].find_all_next("td")[1]
                    content = content.get_text()

                    # https://discord.com/channels/873551443884404796/873956776226205736/1061675227425280052
                    tgt = re.search(r'^GDDR[0-9][A-Z]', content)
                    if tgt is not None:
                        vram_value = re.search(r'[0-9][0-9]GB',content).group()
                        vram_type = re.search(r'GDDR[0-9][A-Z]',content).group()
                    else:
                        tgt = re.search(r'GDDR[0-9]',content)
                        if tgt is not None:
                            vram_type = re.search(r'GDDR[0-9]',content).group()
                            vram_value = content[5:]
                        else:
                            tgt = re.search(r'DDR[0-9]',content)
                            if tgt is not None:
                                vram_type = re.search(r'DDR[0-9]',content).group()
                                vram_value = content[4:]
                            else:
                                tgt = re.search(r'HBM[0-9]',content)
                                if tgt is not None:
                                    vram_type = re.search(r'HBM[0-9]',content).group()
                                    vram_value = content[4:]
                                else:
                                    tgt = re.search(r'HBM[0-9][a-z]',content)
                                    if tgt is not None:
                                        vram_type = re.search(r'HBM[0-9][a-z]',content).group()
                                        vram_value = content[5:]
                                    else:
                                        vram_type = content
                                        vram_value = "0"

                    print("vram info:",vram_type,",",vram_value)
                    #vram_type = content[:idx]
                    #vram_value = content[idx:]

                    #vram_type = vram_type[0:9]
                    #vram_value = vram_value[0:6]

                    content_list = content_list + [vram_type] + [vram_value]

                    # cooling
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[9]
                    else:
                        content = content_table[0].find_all_next("td")[9]
                    content = content.get_text()
                    content = content[0:9]
                    content_list = content_list + [content]

                    # size
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[22]
                    else:
                        content = content_table[0].find_all_next("td")[22]
                    content = content.get_text()
                    content = content[0:24]
                    content_list = content_list + [content]
                    #print(content_list)
                except:
                    content = "Error"
                    content_num = "0"
                    url = u.replace('spec/', '')
                    content_list =[url] + [content] + [content] + [content_num] + [content] + [content] + [content] + [content] + [content] + [content]

            if genre == "ssd":
                content_list = []
                try:
                    # URL
                    url = u.replace('spec/', '')
                    content_list = content_list + [url]
                    # maker
                    content = soup.find(class_="digestMakerName")
                    content = content.get_text()
                    content_list = content_list + [content]

                    # name
                    content = soup.find("h2", attrs={'itemprop': 'name'})
                    content = content.get_text()
                    content = content[0:54]
                    content_list = content_list + [content]

                    # price
                    try:
                        content = soup.find(class_="priceTxt")
                        content = content.get_text()
                        content = content.replace('¥', '').replace(',', '')
                    except:
                        content = "99999999"
                    content_list = content_list + [content]

                    # value
                    content_table = soup.find_all(id='specContents')
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[0]
                    else:
                        content = content_table[0].find_all_next("td")[0]
                    content = content.get_text()
                    tgt = re.search('[a-z]|[A-Z]', content).group()
                    idx = content.find(tgt)
                    content = content[:idx]
                    content = content.replace(' ', '')
                    content_list = content_list + [content]

                    # interface
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[2]
                    else:
                        content = content_table[0].find_all_next("td")[2]
                    content = content.get_text()
                    content = content[0:19]
                    content_list = content_list + [content]

                    # type(size)
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[1]
                    else:
                        content = content_table[0].find_all_next("td")[1]
                    content = content.get_text()
                    if len(content) > 2:
                        content_list = content_list + [content]
                    else:
                        if len(content_table) > 1:
                            content = content_table[1].find_all_next("td")[4]
                        else:
                            content = content_table[0].find_all_next("td")[4]
                        content = content.get_text()
                        content = content[0:19]
                        content_list = content_list + [content]
                        #print("No." + str(num) + "is portable.")

                    # read
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[8]
                    else:
                        content = content_table[0].find_all_next("td")[8]
                    content = content.get_text()
                    if len(content) > 2:
                        tgt = re.search('[a-z]|[A-Z]', content).group()
                        idx = content.find(tgt)
                        content = content[:idx]
                        tgt = "."
                        idx = content.find(tgt)
                        content = content[:idx]
                        content = content.replace(' ', '')
                    else:
                        content = "0"
                    content_list = content_list + [content]

                    # write
                    if len(content_table) > 2:
                        content = content_table[1].find_all_next("td")[9]
                    else:
                        content = content_table[0].find_all_next("td")[9]
                    content = content.get_text()
                    if len(content) > 1:
                        tgt = re.search('[a-z]|[A-Z]', content).group()
                        idx = content.find(tgt)
                        content = content[:idx]
                        tgt = "."
                        idx = content.find(tgt)
                        content = content[:idx]
                        content = content.replace(' ', '')
                    else:
                        content = "0"
                    content_list = content_list + [content]
                except:
                    content = "Error"
                    content_num = "0"
                    url = u.replace('spec/', '')
                    content_list =[url] + [content] + [content] + [content_num] + [content_num] + [content] + [content] + [content_num] + [content_num]

            if genre == "hdd":
                content_list = []
                try:
                    # URL
                    content_list = content_list + [u.replace('spec/', '')]
                    # maker
                    content = soup.find(class_="digestMakerName")
                    content = content.get_text()
                    content_list = content_list + [content]

                    # name
                    content = soup.find("h2", attrs={'itemprop': 'name'})
                    content = content.get_text()
                    content = content[0:55]
                    content_list = content_list + [content]

                    # price
                    try:
                        content = soup.find(class_="priceTxt")
                        content = content.get_text()
                        content = content.replace('¥', '').replace(',', '')
                    except:
                        content = "99999999"
                    content_list = content_list + [content]

                    # value
                    content_table = soup.find_all(id='specContents')
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[0]
                    else:
                        content = content_table[0].find_all_next("td")[0]
                    content = content.get_text()
                    tgt = re.search('[a-z]|[A-Z]', content).group()
                    idx = content.find(tgt)
                    content = content[:idx]
                    content = content.replace(' ', '')
                    content = int(content)
                    if content < 50:
                        content = str(content * 1000)
                    content_list = content_list + [content]

                    # rpm
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[1]
                    else:
                        content = content_table[0].find_all_next("td")[1]
                    content = content.get_text()
                    if len(content) > 2:
                        tgt = re.search('[a-z]|[A-Z]', content).group()
                        idx = content.find(tgt)
                        content = content[:idx]
                        content = content.replace(' ', '')
                    else:
                        content = "0"
                    content_list = content_list + [content]

                    # interface
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[3]
                    else:
                        content = content_table[0].find_all_next("td")[3]
                    content = content.get_text()
                    if len(content) > 2:
                        content = content[0:19]
                        content_list = content_list + [content]
                    else:
                        content = "0"
                        content_list = content_list + [content]
                except:
                    content = "Error"
                    content_num = '0'
                    url = u.replace('spec/', '')
                    content_list =[url] + [content] + [content] + [content_num] + [content_num] + [content_num] + [content]

            if genre == "psu":
                    content_list = []
                    try:
                        # URL
                        content_list = content_list + [u.replace('spec/', '')]
                        # maker
                        content = soup.find(class_="digestMakerName")
                        content = content.get_text()
                        content = content[0:29]
                        content_list = content_list + [content]

                        # name
                        content = soup.find("h2", attrs={'itemprop': 'name'})
                        content = content.get_text()
                        content = content[0:54]
                        content_list = content_list + [content]

                        # price
                        try:
                            content = soup.find(class_="priceTxt")
                            content = content.get_text()
                            content = content.replace('¥', '').replace(',', '')
                        except:
                            content = "99999999"
                        #print(content)
                        content_list = content_list + [content]

                        # value
                        content_table = soup.find_all(id='specContents')
                        if len(content_table) > 1:
                            content = content_table[1].find_all_next("td")[1]
                        else:
                            content = content_table[0].find_all_next("td")[1]
                        content = content.get_text()
                        tgt = re.search('[a-z]|[A-Z]', content).group()
                        idx = content.find(tgt)
                        content = content[:idx]
                        tgt = "."
                        idx = content.find(tgt)
                        content = content[:idx]
                        content = content.replace(' ', '')
                        #print(content)
                        content_list = content_list + [content]

                        # 80+
                        if len(content_table) > 1:
                            content = content_table[1].find_all_next("td")[8]
                        else:
                            content = content_table[0].find_all_next("td")[8]
                        content = content.get_text()
                        content = content[0:9]
                        #print(content)
                        content_list = content_list + [content]

                        # formfacta
                        if len(content_table) > 1:
                            content = content_table[1].find_all_next("td")[0]
                        else:
                            content = content_table[0].find_all_next("td")[0]
                        content = content.get_text()

                        if len(content) > 2:
                            if re.search('SFX', content):

                                if re.search('L', content):
                                    content = "SFX-L"
                                else:
                                    content = "SFX"

                            else:
                                if re.search('3.0', content):
                                    content = "ATX v3.0"
                                elif re.search('(?i)Flex', content):
                                    content = "FlexATX"
                                elif re.search('TFX', content):
                                    content = "TFX"
                                elif re.search('ATX', content):
                                    content = "ATX"
                                else:
                                    content = "Other"
                            #print(content)
                            content_list = content_list + [content]
                            
                        else:
                            content = "Other"
                            #print(content)
                            content_list = content_list + [content]

                        # plugin 1>OK 0>none
                        if len(content_table) > 1:
                            content = content_table[1].find_all_next("td")[3]
                        else:
                            content = content_table[0].find_all_next("td")[3]
                        content = content.get_text()
                        if re.search('○', content):
                            content = '1'
                        else:
                            content = '0'
                        content_list = content_list + [content]
                        #print(content_list)
                    except:
                        content = "Error"
                        content_num = '0'
                        url = u.replace('spec/', '')
                        #print("err")
                        content_list =[url] + [content] + [content] + [content_num] + [content_num] + [content] + [content] + [content_num]

            if genre == "case":
                content_list = []
                try:
                    # URL
                    content_list = content_list + [u.replace('spec/', '')]
                    # maker
                    content = soup.find(class_="digestMakerName")
                    content = content.get_text()
                    content_list = content_list + [content]

                    # name
                    content = soup.find("h2", attrs={'itemprop': 'name'})
                    content = content.get_text()
                    content = content[0:55]
                    content_list = content_list + [content]

                    # price
                    try:
                        content = soup.find(class_="priceTxt")
                        content = content.get_text()
                        content = content.replace('¥', '').replace(',', '')
                    except:
                        content = "99999999"
                    content_list = content_list + [content]

                    # formfacta
                    content_table = soup.find_all(id='specContents')
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[8]
                    else:
                        content = content_table[0].find_all_next("td")[8]

                    content = content.get_text()
                    #print("formfactaRaw",content)
                    if len(content) > 2:
                        if re.search('(?i)Extended|E', content):
                            content = "E-ATX"

                        elif re.search('(?i)^Micro.*$', content):
                            content = "MicroATX"
                        elif re.search('(?i)ATX', content):
                            content = "ATX"
                        elif re.search('(?i)ITX', content):
                            content = "MiniITX"

                        else:
                            content = "Other"
                        #print("caseformfacta:::",content)
                    content_list = content_list + [content]
                    #print("caseAddFormfacta:::", content_list)

                    # CPU-MAX
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[10]
                    else:
                        content = content_table[0].find_all_next("td")[10]
                    content = content.get_text()
                    if len(content) > 2:
                        content = re.search('[0-9][0-9][0-9]', content).group()
                    else:
                        content = "0"
                    content_list = content_list + [content]

                    # GPU-MAX
                    if len(content_table) > 1:
                        content = content_table[1].find_all_next("td")[9]
                    else:
                        content = content_table[0].find_all_next("td")[9]
                    content = content.get_text()
                    if len(content) > 2:
                        content = re.search('[0-9][0-9][0-9]', content).group()
                    else:
                        content = "0"
                    content = content[0:14]
                    content_list = content_list + [content]
                except:
                    content = "Error"
                    content_num = '0'
                    url = u.replace('spec/', '')
                    content_list =[url] + [content] + [content] + [content_num] + [content] + [content_num] + [content_num]

            if genre == "os":
                content_list = []
                try:
                    # URL
                    content_list = content_list + [u.replace('spec/', '')]
                    # maker
                    content = soup.find(class_="digestMakerName")
                    content = content.get_text()
                    content_list = content_list + [content]

                    # name
                    content = soup.find("h2", attrs={'itemprop': 'name'})
                    content = content.get_text()
                    content = content[0:55]
                    content_list = content_list + [content]

                    # price
                    try:
                        content = soup.find(class_="priceTxt")
                        content = content.get_text()
                        content = content.replace('¥', '').replace(',', '')
                    except:
                        content = "99999999"
                    content_list = content_list + [content]

                except:
                    content = "Error"
                    content_num = '0'
                    url = u.replace('spec/', '')
                    content_list =[url] + [content] + [content] + [content_num]

            content_out.append(content_list)
            #print(genre +" "+ str(num) + " ended.")
            num = num + 1
        #print(genre + " is ended.")
        return content_out

    def sql_write(self, content,genre):
        connectable = None
        connection = None

        content0 = []
        content1 = []
        content2 = []
        content3 = []
        content4 = []
        content5 = []
        content6 = []
        content7 = []
        content8 = []
        content9 = []
        content10 = []
        content11 = []
        content12 = []
        j=0
        #'''
        try:
            connection = mysql.connector.connect(
                host="",
                user="",
                password="",
                db=""
            )

            if connection.is_connected:
                print("connected")
                connectable = True
                cur = connection.cursor(buffered=True)
                for c in content:
                    if genre == 'cpu':
                        content0 = c[0]
                        content1 = c[1]
                        content2 = c[2]
                        content3 = int(c[3])
                        content4 = c[4]
                        content5 = c[5]
                        cur.execute("select * from cpu where url= %s",(content0,))
                        check_data =cur.fetchone()
                        if check_data is not None:
                            cur.execute("update cpu set price= %s where url= %s",(content3,content0))
                        else:
                            cur.execute("INSERT INTO cpu VALUES (%s, %s, %s, %s, %s, %s, null)",(content0, content1, content2, content3, content4, content5))

                    elif genre == 'cpuc':
                        content0 = c[0]
                        content1 = c[1]
                        content2 = c[2]
                        content3 = int(c[3])
                        content4 = c[4]
                        content5 = c[5]
                        content6 = c[6]
                        cur.execute("select * from cpuc where url=%s",(content0,))
                        check_data = cur.fetchone()
                        if check_data is not None:
                            cur.execute("update cpuc set price= %s,socket= %s where url= %s", (content3,content5, content0))
                        else:
                            cur.execute("INSERT INTO cpuc VALUES (%s, %s, %s, %s, %s, %s, %s, null)",(content0, content1, content2, content3, content4, content5, content6))

                    elif genre == 'mb':
                        content0 = c[0]
                        content1 = c[1]
                        content2 = c[2]
                        content3 = int(c[3])
                        content4 = c[4]
                        content5 = c[5]
                        content6 = c[6]
                        content7 = c[7]
                        content8 = c[8]
                        content9 = bool(int(c[9]))
                        content10 = bool(int(c[10]))
                        cur.execute("select * from mb where url=%s", (content0,))
                        check_data = cur.fetchone()
                        if check_data is not None:
                            cur.execute("update mb set price= %s where url= %s", (content3, content0))
                        else:
                            cur.execute("INSERT INTO mb VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, null)",(content0, content1, content2, content3, content4, content5, content6, content7, content8,content9, content10))

                    elif genre == 'ram':
                        content0 = c[0]
                        content1 = c[1]
                        content2 = c[2]
                        content3 = int(c[3])
                        content4 = c[4]
                        content5 = c[5]
                        content6 = c[6]
                        content7 = int(c[7])
                        content8 = int(c[8])
                        content9 = int(c[9])
                        content10 = bool(int(c[10]))
                        content11 = bool(int(c[11]))
                        cur.execute("select * from ram where url=%s", (content0,))
                        check_data = cur.fetchone()
                        if check_data is not None:
                            cur.execute("update ram set price= %s,hz= %s where url= %s", (content3, content6, content0))
                        else:
                            cur.execute("INSERT INTO ram VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, null)",(content0, content1, content2, content3, content4, content5, content6, content7, content8,content9, content10, content11))

                        #print('debug')

                    elif genre == 'gpu':
                        content0 = c[0]
                        content1 = c[1]
                        content2 = c[2]
                        content3 = int(c[3])
                        content4 = c[4]
                        content5 = c[5]
                        content6 = c[6]
                        content7 = c[7]
                        content8 = c[8]
                        content9 = c[9]
                        
                        cur.execute("select * from gpu where url=%s", (content0,))
                        check_data = cur.fetchone()
                        if check_data is not None:
                            cur.execute("update gpu set price= %s where url= %s", (content3, content0))
                        else:
                            cur.execute("INSERT INTO gpu VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, null)",(content0, content1, content2, content3, content4, content5, content6, content7, content8, content9))

                    elif genre == 'ssd':
                        content0 = c[0]
                        content1 = c[1]
                        content2 = c[2]
                        content3 = int(c[3])
                        content4 = int(c[4])
                        content5 = c[5]
                        content6 = c[6]
                        content7 = int(c[7])
                        content8 = int(c[8])
                        cur.execute("select * from ssd where url=%s", (content0,))
                        check_data = cur.fetchone()
                        if check_data is not None:
                            cur.execute("update ssd set price= %s where url= %s", (content3, content0))
                        else:
                            cur.execute("INSERT INTO ssd VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, null)",(content0, content1, content2, content3, content4, content5, content6, content7, content8))

                    elif genre == 'hdd':
                        content0 = c[0]
                        content1 = c[1]
                        content2 = c[2]
                        content3 = int(c[3])
                        content4 = int(c[4])
                        content5 = int(c[5])
                        content6 = c[6]
                        cur.execute("select * from hdd where url=%s", (content0,))
                        check_data = cur.fetchone()
                        if check_data is not None:
                            cur.execute("update hdd set price= %s where url= %s", (content3, content0))
                        else:
                            cur.execute("INSERT INTO hdd VALUES (%s, %s, %s, %s, %s, %s, %s, null)",(content0, content1, content2, content3, content4, content5, content6))

                    elif genre == 'psu':
                        #print(c)
                        content0 = c[0]
                        content1 = c[1]
                        content2 = c[2]
                        content3 = int(c[3])
                        content4 = int(c[4])
                        content5 = c[5]
                        content6 = c[6]
                        content7 = bool(int(c[7]))
                        
                        cur.execute("select * from psu where url=%s", (content0,))
                        check_data = cur.fetchone()
                        #print(content0, content1, content2, content3, content4, content5, content6, content7)
                        if check_data is not None:
                            cur.execute("update psu set price= %s where url= %s", (content3, content0))
                        else:
                            cur.execute("INSERT INTO psu VALUES (%s, %s, %s, %s, %s, %s, %s, %s, null)",(content0, content1, content2, content3, content4, content5, content6, content7))

                    elif genre == 'case':
                        bool_temp = 0
                        content0 = c[0]
                        content1 = c[1]
                        content2 = c[2]
                        content3 = int(c[3])
                        content4 = c[4]
                        content5 = int(c[5])
                        content6 = int(c[6])
                        cur.execute("select * from pccase where url=%s", (content0,))
                        check_data = cur.fetchone()
                        if check_data is not None:
                            cur.execute("update pccase set price= %s ,formfactor= %s where url= %s", (content3, content4, content0))
                        else:
                            cur.execute("INSERT INTO pccase VALUES (%s, %s, %s, %s, %s, %s, %s, null)",(content0, content1, content2, content3, content4, content5, content6))

                    elif genre == 'os':
                        bool_temp = 0
                        content0 = c[0]
                        content1 = c[1]
                        content2 = c[2]
                        content3 = int(c[3])
                        cur.execute("select * from os where url=%s", (content0,))
                        check_data = cur.fetchone()
                        if check_data is not None:
                            cur.execute("update os set price= %s where url= %s", (content3, content0))
                        else:
                            cur.execute("INSERT INTO os VALUES (%s, %s, %s, %s, null)",(content0, content1, content2, content3))

                connection.commit()
                connection.close()
                print(genre+" : "+"write ended.")
        except mysql.connector.Error as e:
            print(genre+" : "+e)
        #'''
        connectable = True


    def cpu(self):
        cpu_url = self.scr_GetUrl("cpu")
        cpu_content = self.scr_getContent(cpu_url, "cpu")
        self.sql_write(cpu_content, 'cpu')
    def cpuc(self):
        cpuc_url = self.scr_GetUrl("cpu-cooler")
        cpuc_content = self.scr_getContent(cpuc_url, "cpuc")
        self.sql_write(cpuc_content, 'cpuc')
    def mb(self):
        mb_url = self.scr_GetUrl("motherboard")
        mb_content = self.scr_getContent(mb_url, "mb")
        self.sql_write(mb_content, 'mb')
    def ram(self):
        ram_url = self.scr_GetUrl("pc-memory")
        ram_content = self.scr_getContent(ram_url, "ram")
        self.sql_write(ram_content, 'ram')
    def gpu(self):
        gpu_url = self.scr_GetUrl("videocard")
        gpu_content = self.scr_getContent(gpu_url, "gpu")
        self.sql_write(gpu_content, 'gpu')
    def ssd(self):
        ssd_url = self.scr_GetUrl("ssd")
        ssd_content = self.scr_getContent(ssd_url, "ssd")
        self.sql_write(ssd_content, 'ssd')
    def hdd(self):
        hdd_url = self.scr_GetUrl("hdd-35inch")
        hdd_content = self.scr_getContent(hdd_url, "hdd")
        self.sql_write(hdd_content, 'hdd')
    def psu(self):
        psu_url = self.scr_GetUrl("power-supply")
        psu_content = self.scr_getContent(psu_url, "psu")
        self.sql_write(psu_content, 'psu')
    def case(self):
        case_url = self.scr_GetUrl("pc-case")
        case_content = self.scr_getContent(case_url, "case")
        self.sql_write(case_content, 'case')

    def os(self):
        os_url = self.scr_GetUrl("os-soft")
        os_content = self.scr_getContent(os_url, "os")
        self.sql_write(os_content, 'os')

    def threading(self):

        thread1 = threading.Thread(target=self.cpu)
        thread2 = threading.Thread(target=self.cpuc)
        thread3 = threading.Thread(target=self.mb)
        thread4 = threading.Thread(target=self.ram)
        thread5 = threading.Thread(target=self.gpu)
        thread6 = threading.Thread(target=self.ssd)
        thread7 = threading.Thread(target=self.hdd)
        thread8 = threading.Thread(target=self.psu)
        thread9 = threading.Thread(target=self.case)
        thread10 = threading.Thread(target=self.os)
        #''''''


        thread1.start()
        thread2.start()
        thread3.start()
        thread4.start()
        thread5.start()
        thread6.start()
        thread7.start()
        thread8.start()
        thread9.start()
        thread10.start()

        print("end")


test = dosomething()
#test.case()
test.threading()
