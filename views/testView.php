<?php

?>

<style type="text/css">
    .header {
        background-color: #414141;
        box-shadow: 1px 1px 4px 0 rgba(0,0,0,.1);
        position: relative;
        width: 100%;
        z-index: 3;

        /*display: flex;*/
        /*justify-content: space-between;*/
        /*align-items: center;*/
        /*flex-direction: row;*/
        /*padding: 10px;*/
    }

    /*#brand{*/
    /*    width: 20%;*/
    /*}*/
    .header img{
        width: 50%;
    }
    .header ul {
        margin: 0;
        padding: 0;
        list-style: none;
        overflow: hidden;
    }
    .header li a {
        display: block;
        color: #414141;
        padding: 20px 20px;
        text-decoration: none;
    }

    .header li a:hover,
    .header .menu-btn:hover {
        background-color: rgba(0, 0, 0, 0.10);
    }
    .header .logo {
        color: #fff;
        display: block;
        float: left;
        font-size: 1.5em;
        padding: 12px 20px;
        text-decoration: none;
    }
    .header .menu {
        clear: both;
        max-height: 0;
        transition: max-height .2s ease-out;
    }

    /* menu icon */

    .header .menu-icon {
        cursor: pointer;
        display: inline-block;
        float: right;
        padding: 28px 20px;
        position: relative;
        user-select: none;
    }

    .header .menu-icon .navicon {
        background: #fff;
        display: block;
        height: 2px;
        position: relative;
        transition: background .2s ease-out;
        width: 18px;
    }

    .header .menu-icon .navicon:before,
    .header .menu-icon .navicon:after {
        background: #fff;
        content: '';
        display: block;
        height: 100%;
        position: absolute;
        transition: all .2s ease-out;
        width: 100%;
    }

    .header .menu-icon .navicon:before {
        top: 5px;
    }

    .header .menu-icon .navicon:after {
        top: -5px;
    }

    /* menu btn */

    .header .menu-btn {
        display: none;
    }

    .header .menu-btn:checked ~ .menu {
        max-height: 340px;
    }

    .header .menu-btn:checked ~ .menu-icon .navicon {
        background: transparent;
    }

    .header .menu-btn:checked ~ .menu-icon .navicon:before {
        transform: rotate(-45deg);
    }

    .header .menu-btn:checked ~ .menu-icon .navicon:after {
        transform: rotate(45deg);
    }

    .header .menu-btn:checked ~ .menu-icon:not(.steps) .navicon:before,
    .header .menu-btn:checked ~ .menu-icon:not(.steps) .navicon:after {
        top: 0;
    }

    /* Responsive */
    @media only screen and (max-width: 768px){
        .header ul{
            background-color: #fff;
        }
        .header li a {
            padding: 15px;
            border-bottom: 1px dotted #ddd;

        }
    }

    @media only screen and (min-width: 768px) {
        .menu-wrapper{
            background: #414141;
            height: 55px;
            line-height: 55px;
            width: 100%;
        }
        .header li {
            float: left;
        }
        .header .logo{
            line-height: 1;
        }
        .header li a {
            color: #fff;
            padding: 0px 30px;
            border-right: 1px solid rgba(255, 255, 255, 0.2);

        }
        .header .menu {
            clear: none;
            float: right;
            max-height: none;
        }
        .header .menu-icon {
            display: none;
        }
    }
</style>

<div class="menu-wrapper">
    <header class="header">
        <a href="#home" class="logo">Fakefilx</a>
        <input class="menu-btn" type="checkbox" id="menu-btn" />
        <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
        <ul class="menu">
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="#careers">Careers</a></li>
            <li><a href="#contact">Blog</a></li>
            <li><a href="#contact">News</a></li>
        </ul>
    </header>
</div>

<!--<nav class="menu-wrapper">-->
<!--    <header class="header">-->
<!--        <div id="brand"><a href="--><?//= URL?><!--accueil"><img src="--><?//= URL ?><!--/public/img/logos/logo.png" alt="Fakeflix"></a></div>-->
<!--        <div>-->
<!--            <input class="menu-btn" type="checkbox" id="menu-btn" />-->
<!--            <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>-->
<!--            <ul class="menu">-->
<!--                <li><a href="#about">About</a></li>-->
<!--                <li><a href="#contact">Contact</a></li>-->
<!--                <li><a href="#contact">News</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!---->
<!--    </header>-->
<!--</nav>-->


<script>
</script>