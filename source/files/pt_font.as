;-------------------------------------------------------------------------------
; pt_font.as - font(point size version) function
;-------------------------------------------------------------------------------
;
; Copyright(c) 2011 sharkpp All rights reserved.
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

#module

#uselib "gdi32"
#func  DeleteObject "DeleteObject" sptr
#cfunc CreateFontIndirect "CreateFontIndirectW" var
#func  GetObject "GetObjectW" sptr,sptr,var
#cfunc GetDeviceCaps "GetDeviceCaps" sptr,sptr
#func SelectObject "SelectObject" sptr,sptr
#uselib "kernel32"
#cfunc MulDiv "MulDiv" sptr,sptr,sptr

#const LOGPIXELSY 90 

#const sizeof_LOGFONTW (4+4+4+4+4+1+1+1+1+1+1+1+1+32*2)

#deffunc font_pt str face, int size, int style, local bmscr, local lf
	font face, size, style
	mref bmscr, 67
	dim lf, sizeof_LOGFONTW / 4
	GetObject bmscr(38), sizeof_LOGFONTW, lf
	DeleteObject bmscr(38)
	lf = -MulDiv(size, GetDeviceCaps(hdc, LOGPIXELSY), 72)
	bmscr(38) = CreateFontIndirect(lf)
	SelectObject hdc, bmscr(38)
	return

#global

#if 0

	style = 0,1,2,4,8,16
	repeat 6
		font msgothic, 14, style(cnt)
		mes "0123456789"

		font_pt msgothic, 14, style(cnt)
		mes "0123456789"
	loop

#endif

