<?php

namespace App\Core\Classes;

class PageNav
{
    protected $id;
    protected $startChar;
    protected $prevChar;
    protected $nextChar;
    protected $endChar;
     
    /**
     * �����������
     * @param string $id        - ������� ID �������� <UL> - ������������ ���������
     * @param string $startChar - ����� ������ "� ������"
     * @param string $prevChar  - ����� ������ "�����"
     * @param string $nextChar  - ����� ������ "������"
     * @param string $endChar   - ����� ������ "� �����"
     */
    public function __construct( /*string*/ $id     = 'pagination', 
                                 /*string*/ $startChar = '&laquo;', 
                                 /*string*/ $prevChar  = '&lsaquo;', 
                                 /*string*/ $nextChar  = '&rsaquo;', 
                                 /*string*/ $endChar   = '&raquo;'  )
    {
      $this->id = $id;
    //  $this->startChar = $startChar;
      //$this->prevChar  = $prevChar;
     // $this->nextChar  = $nextChar;
    //  $this->endChar   = $endChar;
    }   
     
  /**
   * �������� HTML - ��� ������������ ���������
   * @param int $all        - ������ ���-�� ��������� (���������� � ���������) 
   * @param int $limit      - ���-�� ��������� �� ��������
   * @param int $start      - ������� �������� ���������
   * @param int $linkLimit  - ���������� ������ � ���������
   * @param string $varName - ��� GET - ���������� ������� ����� �������������� � �����. ���������.
   * @return string
   */
    public function getLinks( /*int*/ $all, /*int*/ $limit, /*int*/ $start, $linkLimit = 10, $varName = 'start' )
    {
      // ������� �� ������, ���� ����� ������ ��� ����� ���-�� ���� ��������� ������,
      // � ���� ����� = 0. 0 - ����� �������� "�� ��������� � ���������".
      if ( $limit >= $all || $limit == 0 ) {
        return NULL;
      }     
         
      $pages     = 0;       // ���-�� ������� � ���������
      $needChunk = 0;       // ������ ������� � ������ ������ �����
      $queryVars = array(); // �����. ������ ���������� �� ������ �������
      $pagesArr  = array(); // ��������� ��� �������������� �������� ������� ���������
      $htmlOut   = '';      // HTML - ��� ������������ ���������
      $link      = NULL;    // ����������� ������
       
      // � ���� ����� �� ������ ������ ������ - ����� ��, ��� ��, �� �������
      // ������ �� ������ ��������, �� ��������� �� �� ���� GET-����������: 
      parse_str($_SERVER['QUERY_STRING'], $queryVars ); //   &$queryVars
       
      // ������� ���� GET-����������
      if( isset($queryVars[$varName]) ) {
        unset( $queryVars[$varName] );
      }
       
      // ��������� ����� �� ������, ������� �� ��� �� ��������:
      $link  = $_SERVER['PHP_SELF'].'?'.http_build_query( $queryVars );
 
      //-------------------------------------------------------- 
       
      $pages = ceil( $all / $limit ); // ���-�� �������
       
      // ��������� ������: ���� - ��� ����� ��������, �������� - ��� �������� ��� ��.
      // ��������� ����� ����� � �������. � �������� � ����� = ���-�� ���������� �� ��������.
      for( $i = 0; $i < $pages; $i++) {
          $pagesArr[$i+1] = $i * $limit;
      }
       
      // ������ ��� �� �� �������� ���������� ������ ���-�� ������
      // ������ ������ �� ���������� [� ��������] => "��������" �� 
      // ����� (�����)
      $allPages = array_chunk($pagesArr, $linkLimit, true);
       
      // �������� ������ ����� � ������� ��������� ������ ��������.
      // � ����� ������ �� ���� ���������� ������ ������:
      $needChunk = $this->searchPage( $allPages, $start );
       
      // ��������� ������ "� ������", "�����������" ------------------------------------------------
       
      if ( $start > 1 ) {
        $htmlOut .= '<a href="'.$link.'&'.$varName.'=0">'.$this->startChar.'</a>'.
                    '<a href="'.$link.'&'.$varName.'='.($start - $limit).'">'.$this->prevChar.'</a>';   
      } else {
        $htmlOut .= '<span>'.$this->startChar.'</span>'.
                    '<span>'.$this->prevChar.'</span>'; 
      }
      // ������ ������� ������ �� ������� �����
      foreach( $allPages[$needChunk] AS $pageNum => $ofset )  {
        // ������ ������� �������� �� ��������:
        if( $ofset == $start  ) {
            $htmlOut .= '<span>'. $pageNum .'</span>';            
            continue;
        }        
        $htmlOut .= '<a href="'.$link.'&'.$varName.'='. $ofset .'">'. $pageNum . '</a>';
      }
         
      // ��������� ������ "���������", "� �����" ------------------------------------------------
         
      if ( ($all - $limit) >  $start) {
        $htmlOut .= '<a href="' . $link . '&' . $varName . '=' . ( $start + $limit) . '">' . $this->nextChar . '</a>'.
                    '<a href="' . $link . '&' . $varName . '=' . array_pop( array_pop($allPages) ) . '">' . $this->endChar . '</a>';            
      } else {
        $htmlOut .= '<span>' . $this->nextChar . '</span>'.
                    '<span>' . $this->endChar . '</span>';         
      }         
      return '<ul id="'.$this->id.'">' . $htmlOut . '<ul>';
    }
 
    /**
     * ���� � ����� ����� ��������� ������� �� ��������� $needPage
     * @param array $pagesList ������ ������ (�������� ������� �������� �� ������ ������ �� ��������)
     * @param int $needPage - ��������
     * @return number ���� ����� � ������� ���� ������ ��������
     */
    protected function searchPage( array $pagesList, /*int*/$needPage )
    {
        foreach( $pagesList AS $chunk => $pages  ){
            if( in_array($needPage, $pages) ){
                return $chunk;
            }
        }
        return 0;
    }    
}