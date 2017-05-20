;-------------------------------------------------------------------------------
; mod_get_location.hsp - My location provides module(���݈ʒu�擾���W���[��)
;-------------------------------------------------------------------------------
;
; Copyright(c) 2010 sharkpp All rights reserved.
;
; The MIT License
;
; Permission is hereby granted, free of charge, to any person obtaining a copy
; of this software and associated documentation files (the "Software"), to deal
; in the Software without restriction, including without limitation the rights
; to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
; copies of the Software, and to permit persons to whom the Software is
; furnished to do so, subject to the following conditions:
;
; The above copyright notice and this permission notice shall be included in
; all copies or substantial portions of the Software.
;
; THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
; IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
; FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
; AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
; LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
; OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
; THE SOFTWARE.
;
;*******************************************************************************
; �ȉ��ɎQ�l�Ƃ��� The MIT License �̓��{���𕹋L���܂����A�Еz�����Ƃ��ẮA
; ��L�����ɏ]���Ă��������B
;*******************************************************************************
;
; The MIT License
;
; �ȉ��ɒ�߂�����ɏ]���A�{�\�t�g�E�F�A����ъ֘A�����̃t�@�C��
; �i�ȉ��u�\�t�g�E�F�A�v�j�̕������擾���邷�ׂĂ̐l�ɑ΂��A�\�t�g�E�F�A��
; �������Ɉ������Ƃ𖳏��ŋ����܂��B����ɂ́A�\�t�g�E�F�A�̕������g�p�A
; ���ʁA�ύX�A�����A�f�ځA�Еz�A�T�u���C�Z���X�A�����/�܂��͔̔����錠���A
; ����у\�t�g�E�F�A��񋟂��鑊��ɓ������Ƃ������錠�����������Ɋ܂܂�
; �܂��B
;
; ��L�̒��쌠�\������і{�����\�����A�\�t�g�E�F�A�̂��ׂĂ̕����܂��͏d�v
; �ȕ����ɋL�ڂ�����̂Ƃ��܂��B
;
; �\�t�g�E�F�A�́u����̂܂܁v�ŁA�����ł��邩�Öقł��邩���킸�A�����
; �ۏ؂��Ȃ��񋟂���܂��B�����ł����ۏ؂Ƃ́A���i���A����̖ړI�ւ̓K�����A
; ����ь�����N�Q�ɂ��Ă̕ۏ؂��܂݂܂����A����Ɍ��肳�����̂ł͂���
; �܂���B��҂܂��͒��쌠�҂́A�_��s�ׁA�s�@�s�ׁA�܂��͂���ȊO�ł��낤
; �ƁA�\�t�g�E�F�A�ɋN���܂��͊֘A���A���邢�̓\�t�g�E�F�A�̎g�p�܂��͂���
; ���̈����ɂ���Đ������؂̐����A���Q�A���̑��̋`���ɂ��ĉ���̐ӔC��
; ����Ȃ����̂Ƃ��܂��B 
;
;-------------------------------------------------------------------------------

#include "hspinet.as"

#module ;"mod_get_location"

#const BUFF_SIZE 1024*1024

#defcfunc get_location local r, local tmp, local begin, local len
	; �l�b�g������
	netinit@
	if stat : return ""

	netagent@ "Mozilla/5.0"
	neturl@ "http://www.google.co.jp/"
	netrequest_get@ "search?q=hsp&num=1"

*loop_for_download
	netexec@ r
	if r < 0 : return ""
	if 0 == r {
		await 0
		goto *loop_for_download
	}

	netgetv@ tmp
	nkfcnv@ r, tmp, "s", -1, BUFF_SIZE

	tmp = ""

	START_MARKER = "<li class=\"tbos\">"
	begin =	instr(r, 0, START_MARKER)
	if 0 <= begin {
		begin += strlen(START_MARKER)
		len = instr(r, begin, "<")
		if 0 < len {
			tmp = strmid(r, begin, len)
		}
	}

	return tmp

#global

; n = gettime(6) * 1000 + gettime(7)
; mes get_location()
; m = gettime(6) * 1000 + gettime(7)
; mes strf("%dms", m - n)

