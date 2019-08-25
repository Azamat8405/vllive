<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class AdminController
{
    public function dashboard()
    {

//        http://parliament-osetia.ru/rss
//        https://rso-government.org/feed/

//        Пресс-службы государственных и муниципальных учреждений.
//    Пресс-службы политических партий.
//    Пресс-службы коммерческих организаций.
//    Другие местные Интернет-СМИ.
//    Оффлайн-СМИ.
//    Платные ленты информагентств.
//    Местные форумы, блоги, группы в социальных сетях.
//    Ваши корреспонденты.

        // Администрации района, города, области, местные управления МВД, ФСБ, ФСКН, ФСИН, ФНС, ФМС, МЧС и других


        // https://habr.com/ru/post/288864/

        $number = random_int(0, 100);

        return new Response('<html>
                <head>
                    <script src="https://unpkg.com/react@16/umd/react.development.js" crossorigin></script>
                    <script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js" crossorigin></script>
                    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
                </head>
                <body>
                    <div id="content">
                        <nav id="leftMenu"></nav>
                        <nav id="workPanel"></nav>
                    </div>
                    <script type="text/babel" >
                        var leftMenuData = [
                            {
                                id:     1,
                                title:  "Список источников",
                                link:   "/sources"
                            },
                            {
                                id:2,
                                title:"menu 2",
                                link:"link2"
                            },
                            {
                                id:3,
                                title:"menu 3",
                                link:"link3"
                            }
                        ];
                        class LeftMenuItem extends React.Component{
                            constructor(props) {
                                super();

                                // Эта привязка обязательна для работы `this` в колбэке.
                                this.clickMenu = this.clickMenu.bind(this);
                            }
                            clickMenu (e){
                                e.preventDefault();
                                this.loadWorkPanelContent(e.target.href);
                            }
                            loadWorkPanelContent (url){
                                console.log( url );
                            }
                            render() {
                                return <li><a onClick={this.clickMenu} href={this.props.link}>{this.props.title}</a></li>;
                            }
                        }

                        class MenuLeft extends React.Component {
                          render() {
                            return <div>
                                    <h2>{this.props.name}</h2>
                                    <ul>
                                    {
                                        leftMenuData.map(function(el){
                                            return <LeftMenuItem key={el.id} title={el.title} link={el.link} />;
                                        })
                                    }
                                    </ul>
                                </div>;
                          }
                        }
                        const menuLeft = <MenuLeft name="Левая панель навигации" />;
                        ReactDOM.render(
                            <div>
                                {menuLeft}
                            </div>,
                            document.getElementById("leftMenu")
                        );
                    </script>
                </body></html>'
        );
    }
}