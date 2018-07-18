<?php

declare(strict_types=1);

class Parser 
{
    private $map = [
        ' _ ' => [
            '| |' => [
              '|_|'=>0
            ],
            ' _|' => [
              '|_ '=>2,
              ' _|'=>3
            ],
            '|_ ' => [
              ' _|'=>5,
              '|_|'=>6
            ],
            '  |' => [
              '  |'=>7
            ],
            '|_|' => [
              '|_|'=>8,
              ' _|'=>9
            ]
        ],
        '   '=> [
            '|  ' => [
              '|  '=>1
            ],
            '|_|' => [
              ' | '=>4
            ]
        ]
    ];

    public function parse(String $raw) : Array
    {
        $output = [];
        $digits = [];
 
        $lines = explode("\n", $raw);
        $lcount = count($lines);
        if($lcount < 3) return $output;
        $rcount = 0;
        for($k=0;$k<$lcount;$k++) {
            $line = $lines[$k];
            if(trim($line) == '') {
                $rcount = 0;
                continue;
            }

            $ccount = strlen($line);
            $dindex = 0;
            for($i=0;$i<$ccount;$i+=4){
                $seg = $line[$i].$line[$i+1].$line[$i+2];
                if(!isset($digits[$dindex])) $digits[$dindex] = [];
                $digits[$dindex][] = $seg;
                $dindex++;
            }
            $rcount++;
            
            if($rcount == 3) {
                
                $out = '';
                foreach($digits as $d) {
                  $num = $this->map[$d[0]][$d[1]][$d[2]] ?? null;
                  if($num === null) echo('unable to parse segment');
                  else $out .= $num;
                };
                $output[] = $out;
                $digits = [];
                $rcount = 0;
            }
            
        }

        return $output;
    }
}