class P4 {
    constructor(selector, colone, ligne)
    {
        this.COL = 7;
        this.LGN = 6;
        this.selector = selector;
        this.player = 'red';
        this.drawGame();
        this.fillCells();
        this.checkWin();
    }

    //AFFICHAGE JEU
    drawGame()
    {
        const $jeux = $(this.selector);

        for(let lgn = 0; lgn < this.LGN; lgn++)
        {
            const $lgn = $('<div>').addClass('lgn');
            for(let col = 0; col < this.COL; col++)
            {
                const $col = $('<div>').addClass('col empty').attr('data-col', col).attr('data-lgn', lgn);
                $lgn.append($col);
            }
            $jeux.append($lgn);
        }
    }

    fillCells()
    {
        const $jeux = $(this.selector); 
        const that = this;

        //DERNIERE CASE LIBRE 
        function lastCase(col)
        {
            const $cells = $(`.col[data-col='${col}']`);
            for(let i = $cells.length-1; i >= 0; i--)
            {
                const $cell = $($cells[i]);
                if($cell.hasClass('empty'))
                {
                    return $cell;
                }
            }
            return null;
        }

        //PRE AFFICHAGE COULEUR
        $jeux.on('mouseenter', '.col.empty', function()
        {
            const $col = $(this).data('col');
            const $last = lastCase($col);
            if($last != null)
            {
                $last.addClass(`p${that.player}`);
            }
        });
        $jeux.on('mouseleave', '.col', function()
        {
            $('.col').removeClass(`p${that.player}`);
        });

        //REMPLISSAGE
        $jeux.on('click', '.col.empty', function()
        {
            const col = $(this).data('col');
            const $last = lastCase(col);
            $last.addClass(`${that.player}`).removeClass(`empty p${that.player}`).data('player', `${that.player}`);

            //WINNER
            const winner = that.checkWin($last.data('lgn'), $last.data('col'));
            //SWITCH COULEUR
            that.player = (that.player === 'red') ? 'yellow' : 'red';

            //ANNONCE GAGNANT
            if(winner)
            {
                alert(`Le joueur ${winner} a gagné`);
                $('#restart').css('visibility', "visible");
            }
        });
    }

    //CALCUL GAGNANT
    checkWin(lgn, col)
    {
        const that = this;
        //RECUPERER COORDONNEES
        function $getCell(i, j)
        {
            return $(`.col[data-lgn='${i}'][data-col='${j}']`);
        }

        function checkDirection(direction)
        {
            let total = 0;
            let i = lgn + direction.i;
            let j = col + direction.j;
            let $next = $getCell(i, j);
            while(i >= 0 && i < that.LGN && j >= 0 && j < that.COL && $next.data('player') === that.player)
            {
                total++;
                i += direction.i;
                j += direction.j;
                $next = $getCell(i, j);
            }
            return total;
        }

        function checkWin(directionA , directionB)
        {
            const total = 1 + checkDirection(directionA) + checkDirection(directionB);
            if(total >= 4)
            {
                return that.player;
            }  
            else
            {
                return null;
            }
        }

        function checkHori()
        {
            return checkWin({i: 0, j: -1}, {i: 0, j: 1});
        }
        function checkVert()
        {
            return checkWin({i: -1, j: 0}, {i: 1, j: 0});
        }
        function checkDiag1()
        {
            return checkWin({i: 1, j: 1}, {i: -1, j: -1});
        }
        function checkDiag2()
        {
            return checkWin({i: 1, j: -1}, {i: -1, j: 1});
        }
        return checkHori() || checkVert() || checkDiag1() || checkDiag2();
    }
}