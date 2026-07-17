<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Фитнес клуб ReGYM в Кургане - современный спортзал с профессиональным оборудованием и опытными тренерами">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ReGYM - Фитнес клуб в Кургане')</title>
    
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        
        :root {
            --color-black: #1a1c2a;
            --color-dark: #0f1119;
            --color-yellow: #FFD700;
            --color-yellow-light: #FFF9C4;
            --color-yellow-dark: #F59E0B;
            --color-gray: #2d2f3e;
            --color-gray-light: #3a3c4e;
            --color-gray-bg: #252734;
            --color-gray-map: #1e202e;
            --color-white: #ffffff;
            --color-text: #cbd5e1;
            --color-text-light: #94a3b8;
            --color-border: rgba(255, 215, 0, 0.15);
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 5px 20px rgba(0, 0, 0, 0.15);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.2);
            --shadow-yellow: 0 5px 25px rgba(255, 215, 0, 0.15);
            --transition-fast: all 0.2s ease;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: all 0.5s ease;
            --header-height: 80px;
            --header-height-mobile: 70px;
            --container-padding: clamp(16px, 4vw, 40px);
            --section-padding: clamp(60px, 8vw, 100px);
            --border-radius: 12px;
            --border-radius-sm: 8px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html {
            scroll-behavior: smooth;
            scroll-padding-top: calc(var(--header-height) + 20px);
        }
        
        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            line-height: 1.6;
            color: var(--color-text);
            background-color: var(--color-black);
            overflow-x: hidden;
            -webkit-tap-highlight-color: transparent;
        }
        
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 var(--container-padding);
            width: 100%;
        }
        
        
        h1, h2, h3, h4, h5, h6 {
            color: var(--color-white);
            font-weight: 700;
            line-height: 1.2;
        }
        
        
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: var(--header-height);
            background: rgba(26, 28, 42, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--color-border);
            z-index: 1000;
            transition: var(--transition);
        }
        
        .header.scrolled {
            background: rgba(15, 17, 25, 0.98);
            box-shadow: var(--shadow-md);
        }
        
        .header-container {
            height: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 var(--container-padding);
            max-width: 1280px;
            margin: 0 auto;
            gap: 20px;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            transition: var(--transition-fast);
            flex-shrink: 0;
        }
        
        .logo-container:hover {
            transform: translateY(-2px);
        }
        
        .logo-img {
            width: 45px;
            height: 45px;
            object-fit: contain;
        }
        
        .logo-text {
            font-size: 28px;
            font-weight: 800;
            color: var(--color-white);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            line-height: 1;
        }
        
        .logo-text span:first-child {
            color: var(--color-yellow);
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
        }
        
        
        .nav {
            display: flex;
            gap: 32px;
            margin: 0 auto;
        }
        
        .nav-link {
            color: var(--color-white);
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            padding: 8px 0;
            white-space: nowrap;
            transition: var(--transition-fast);
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--color-yellow), var(--color-yellow-dark));
            transition: width 0.3s ease;
            border-radius: 2px;
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }
        
        .nav-link:hover {
            color: var(--color-yellow);
        }
        
        .header-contacts {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-shrink: 0;
        }
        
        .phone {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--color-white);
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            white-space: nowrap;
            transition: var(--transition-fast);
            padding: 8px 12px;
            border-radius: 40px;
            background: rgba(255, 215, 0, 0.05);
        }
        
        .phone i {
            font-size: 14px;
            color: var(--color-yellow);
        }
        
        .phone:hover {
            color: var(--color-yellow);
            background: rgba(255, 215, 0, 0.1);
        }
        
        .social-links {
            display: flex;
            gap: 12px;
        }
        
        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            color: var(--color-yellow);
            text-decoration: none;
            font-size: 18px;
            border-radius: 50%;
            background: rgba(255, 215, 0, 0.1);
            transition: var(--transition-fast);
        }
        
        .social-link:hover {
            background: var(--color-yellow);
            color: var(--color-black);
            transform: translateY(-3px);
        }
        
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 215, 0, 0.08);
            padding: 5px 12px 5px 16px;
            border-radius: 40px;
            transition: var(--transition-fast);
            border: 1px solid transparent;
        }
        
        .user-profile:hover {
            background: rgba(255, 215, 0, 0.15);
            border-color: rgba(255, 215, 0, 0.2);
        }
        
        .user-profile-link {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--color-yellow);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: var(--transition-fast);
        }
        
        .user-profile-link i {
            font-size: 22px;
        }
        
        .user-profile-link:hover {
            color: var(--color-white);
        }
        
        .user-name {
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .logout-btn {
            background: none;
            border: none;
            color: var(--color-text);
            cursor: pointer;
            font-size: 18px;
            padding: 5px;
            transition: var(--transition-fast);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            width: 32px;
            height: 32px;
        }
        
        .logout-btn:hover {
            color: #ef4444;
            background: rgba(239, 68, 68, 0.1);
            transform: translateX(2px);
        }
        
        
        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .auth-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 40px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: var(--transition-fast);
        }
        
        .auth-link i {
            font-size: 14px;
        }
        
        .login-link {
            background: transparent;
            color: var(--color-white);
            border: 1px solid var(--color-yellow);
        }
        
        .login-link:hover {
            background: rgba(255, 215, 0, 0.1);
            transform: translateY(-2px);
            color: var(--color-yellow);
        }
        
        .register-link {
            background: linear-gradient(135deg, var(--color-yellow), var(--color-yellow-dark));
            color: var(--color-black);
            box-shadow: var(--shadow-yellow);
        }
        
        .register-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 215, 0, 0.3);
        }
        
        
        .mobile-menu-btn {
            display: none;
            width: 32px;
            height: 32px;
            position: relative;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            z-index: 1001;
        }
        
        .mobile-menu-btn span {
            display: block;
            position: absolute;
            height: 3px;
            width: 100%;
            background: var(--color-yellow);
            border-radius: 3px;
            transition: var(--transition);
            left: 0;
        }
        
        .mobile-menu-btn span:nth-child(1) { top: 6px; }
        .mobile-menu-btn span:nth-child(2) { top: 50%; transform: translateY(-50%); }
        .mobile-menu-btn span:nth-child(3) { bottom: 6px; }
        
        .mobile-menu-btn.active span:nth-child(1) {
            transform: rotate(45deg);
            top: 14px;
        }
        
        .mobile-menu-btn.active span:nth-child(2) {
            opacity: 0;
        }
        
        .mobile-menu-btn.active span:nth-child(3) {
            transform: rotate(-45deg);
            bottom: 14px;
        }
        
        
        .mobile-menu {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: var(--color-dark);
            padding: calc(var(--header-height-mobile) + 30px) var(--container-padding) 40px;
            transform: translateX(100%);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 999;
            overflow-y: auto;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        
        .mobile-menu.active {
            transform: translateX(0);
        }
        
        .mobile-nav {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .mobile-nav-link {
            color: var(--color-white);
            text-decoration: none;
            font-size: 18px;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 215, 0, 0.1);
            font-weight: 600;
            text-transform: uppercase;
            transition: var(--transition-fast);
        }
        
        .mobile-nav-link:hover {
            color: var(--color-yellow);
            padding-left: 10px;
        }
        
        .mobile-contacts {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 215, 0, 0.1);
        }
        
        .mobile-phone {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--color-white);
            text-decoration: none;
            font-size: 20px;
            font-weight: 700;
            padding: 12px 0;
        }
        
        .mobile-phone i {
            font-size: 22px;
            color: var(--color-yellow);
        }
        
        .mobile-social-links {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .mobile-social-link {
            color: var(--color-yellow);
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            padding: 10px 20px;
            background: rgba(255, 215, 0, 0.1);
            border-radius: 40px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition-fast);
        }
        
        .mobile-social-link:hover {
            background: var(--color-yellow);
            color: var(--color-black);
        }
        
        .mobile-auth {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 215, 0, 0.2);
        }
        
        .mobile-auth-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            background: rgba(255, 215, 0, 0.08);
            border-radius: var(--border-radius-sm);
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            transition: var(--transition-fast);
        }
        
        .mobile-auth-link i {
            font-size: 20px;
            width: 24px;
        }
        
        .mobile-auth-link:first-child {
            background: rgba(255, 215, 0, 0.12);
            color: var(--color-yellow);
        }
        
        .mobile-auth-link:first-child:hover {
            background: rgba(255, 215, 0, 0.2);
            transform: translateX(5px);
        }
        
        .mobile-auth-link:last-child {
            background: linear-gradient(135deg, var(--color-yellow), var(--color-yellow-dark));
            color: var(--color-black);
        }
        
        .mobile-auth-link:last-child:hover {
            transform: translateX(5px);
            box-shadow: var(--shadow-yellow);
        }
        
        .mobile-logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            justify-content: center;
            width: 100%;
            padding: 14px 20px;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: var(--border-radius-sm);
            color: #ef4444;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition-fast);
        }
        
        .mobile-logout-btn i {
            font-size: 20px;
        }
        
        .mobile-logout-btn:hover {
            background: rgba(239, 68, 68, 0.2);
            transform: translateX(5px);
        }
        
        
        main {
            margin-top: var(--header-height);
            min-height: calc(100vh - var(--header-height));
        }
        
        
        .footer {
            background: var(--color-dark);
            color: var(--color-text);
            padding: clamp(50px, 8vw, 80px) 0 30px;
            border-top: 1px solid var(--color-border);
            margin-top: 60px;
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 40px;
            margin-bottom: 50px;
        }
        
        .footer-column {
            display: flex;
            flex-direction: column;
        }
        
        .footer-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
            text-decoration: none;
        }
        
        .footer-logo-img {
            width: 45px;
            height: 45px;
            object-fit: contain;
        }
        
        .footer-logo-text {
            font-size: 26px;
            font-weight: 800;
            color: var(--color-white);
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 1;
        }
        
        .footer-logo-text span:first-child {
            color: var(--color-yellow);
        }
        
        .footer-info {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .footer-info-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        
        .footer-info-label {
            color: var(--color-yellow);
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .footer-info-value {
            color: var(--color-white);
            font-weight: 500;
            font-size: 15px;
            text-decoration: none;
            transition: var(--transition-fast);
        }
        
        .footer-info-value:hover {
            color: var(--color-yellow);
        }
        
        .footer-title {
            color: var(--color-white);
            font-size: 18px;
            margin-bottom: 25px;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
            position: relative;
            padding-bottom: 12px;
        }
        
        .footer-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, var(--color-yellow), transparent);
            border-radius: 2px;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 12px;
        }
        
        .footer-links a {
            color: var(--color-text);
            text-decoration: none;
            transition: var(--transition-fast);
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .footer-links a i {
            font-size: 12px;
            opacity: 0;
            transition: var(--transition-fast);
        }
        
        .footer-links a:hover {
            color: var(--color-yellow);
            transform: translateX(8px);
        }
        
        .footer-links a:hover i {
            opacity: 1;
        }
        
        .footer-social-grid {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .footer-social-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: rgba(255, 215, 0, 0.05);
            border-radius: var(--border-radius-sm);
            border: 1px solid transparent;
            transition: var(--transition-fast);
            text-decoration: none;
        }
        
        .footer-social-item:hover {
            border-color: rgba(255, 215, 0, 0.3);
            background: rgba(255, 215, 0, 0.1);
            transform: translateX(5px);
        }
        
        .footer-social-item i {
            font-size: 20px;
            color: var(--color-yellow);
        }
        
        .footer-social-text {
            color: var(--color-white);
            font-weight: 500;
            font-size: 14px;
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 13px;
            color: var(--color-text-light);
        }
        
        .footer-bottom a {
            color: var(--color-yellow);
            text-decoration: none;
            transition: var(--transition-fast);
        }
        
        .footer-bottom a:hover {
            opacity: 0.8;
            text-decoration: underline;
        }
        
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 32px;
            background: linear-gradient(135deg, var(--color-yellow), var(--color-yellow-dark));
            color: var(--color-black);
            text-decoration: none;
            border-radius: var(--border-radius-sm);
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: 0.5s;
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
        }
        
        .btn-outline {
            background: transparent;
            border: 2px solid var(--color-yellow);
            color: var(--color-white);
        }
        
        .btn-outline:hover {
            background: var(--color-yellow);
            color: var(--color-black);
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.2);
        }
        
        
        .section {
            padding: var(--section-padding) 0;
            position: relative;
        }
        
        .section-bg-dark {
            background: var(--color-gray-bg);
        }
        
        .section-bg-map {
            background: var(--color-gray-map);
        }
        
        .section-title {
            text-align: center;
            font-size: clamp(32px, 5vw, 42px);
            margin-bottom: 20px;
            color: var(--color-white);
            position: relative;
        }
        
        .section-title span {
            color: var(--color-yellow);
            position: relative;
            display: inline-block;
        }
        
        .section-title span::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            height: 8px;
            background: rgba(255, 215, 0, 0.2);
            border-radius: 4px;
            z-index: -1;
        }
        
        .section-subtitle {
            text-align: center;
            font-size: clamp(16px, 2vw, 18px);
            color: var(--color-text-light);
            max-width: 700px;
            margin: 0 auto 50px;
            line-height: 1.6;
        }
        
        
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: var(--color-gray);
            padding: 40px;
            border-radius: var(--border-radius);
            border: 1px solid var(--color-border);
            box-shadow: var(--shadow-lg);
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 10px;
            color: var(--color-white);
            font-weight: 600;
            font-size: 14px;
        }
        
        .form-control {
            width: 100%;
            padding: 14px 18px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--color-border);
            border-radius: var(--border-radius-sm);
            font-size: 15px;
            color: var(--color-white);
            transition: var(--transition-fast);
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--color-yellow);
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }
        
        textarea.form-control {
            min-height: 120px;
            resize: vertical;
            font-family: inherit;
        }
        
        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='%23FFD700' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 18px center;
            padding-right: 45px;
        }
        
        
        .map-container {
            height: 450px;
            border-radius: var(--border-radius);
            overflow: hidden;
            margin-bottom: 30px;
            border: 2px solid rgba(255, 215, 0, 0.2);
            box-shadow: var(--shadow-lg);
        }
        
        .contact-info {
            background: var(--color-gray);
            padding: 30px;
            border-radius: var(--border-radius);
            text-align: center;
            border: 1px solid var(--color-border);
        }
        
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        
        @media (max-width: 1024px) {
            .nav {
                gap: 20px;
            }
            
            .nav-link {
                font-size: 13px;
            }
        }
        
        @media (max-width: 992px) {
            .header {
                height: var(--header-height-mobile);
            }
            
            main {
                margin-top: var(--header-height-mobile);
            }
            
            .nav,
            .social-links {
                display: none;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .logo-img {
                width: 38px;
                height: 38px;
            }
            
            .logo-text {
                font-size: 22px;
            }
            
            .phone span {
                display: none;
            }
            
            .phone {
                padding: 8px 12px;
            }
            
            .phone i {
                font-size: 16px;
                margin: 0;
            }
            
            .auth-link span {
                display: none;
            }
            
            .auth-link {
                padding: 8px 12px;
            }
            
            .auth-link i {
                font-size: 16px;
                margin: 0;
            }
            
            .user-name {
                display: none;
            }
            
            .user-profile {
                padding: 5px 10px;
            }
        }
        
        @media (max-width: 768px) {
            .footer-grid {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 35px;
            }
            
            .footer-logo {
                justify-content: center;
            }
            
            .footer-info {
                align-items: center;
            }
            
            .footer-info-item {
                align-items: center;
            }
            
            .footer-title::after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .footer-links {
                text-align: center;
            }
            
            .footer-links a {
                justify-content: center;
            }
            
            .footer-social-grid {
                align-items: center;
            }
            
            .footer-social-item {
                width: 100%;
                max-width: 250px;
                margin: 0 auto;
            }
            
            .form-container {
                padding: 30px 20px;
                margin: 0 20px;
            }
            
            .map-container {
                height: 350px;
                margin: 0 20px 20px;
            }
            
            .contact-info {
                margin: 0 20px;
            }
        }
        
        @media (max-width: 480px) {
            :root {
                --container-padding: 16px;
            }
            
            .logo-text {
                font-size: 18px;
            }
            
            .logo-img {
                width: 32px;
                height: 32px;
            }
            
            .mobile-menu {
                padding: calc(var(--header-height-mobile) + 20px) var(--container-padding) 30px;
            }
            
            .mobile-nav-link {
                font-size: 16px;
                padding: 12px 0;
            }
            
            .mobile-phone {
                font-size: 18px;
            }
            
            .mobile-social-links {
                flex-direction: column;
            }
            
            .mobile-social-link {
                justify-content: center;
            }
            
            .form-container {
                padding: 25px 16px;
            }
            
            .btn {
                padding: 12px 24px;
                font-size: 13px;
            }
        }
        
        @media (max-width: 360px) {
            .logo-text {
                font-size: 16px;
            }
            
            .logo-img {
                width: 28px;
                height: 28px;
            }
            
            .phone {
                padding: 6px 10px;
            }
            
            .auth-link {
                padding: 6px 10px;
            }
        }
        
        
        @media (max-height: 600px) and (orientation: landscape) {
            .mobile-menu {
                padding: calc(var(--header-height-mobile) + 20px) var(--container-padding) 20px;
            }
            
            .mobile-nav {
                gap: 10px;
                margin-bottom: 20px;
            }
            
            .mobile-nav-link {
                padding: 10px 0;
                font-size: 15px;
            }
            
            .mobile-contacts {
                gap: 15px;
                padding-top: 15px;
            }
        }
        
        
        @media (hover: none) and (pointer: coarse) {
            .btn:active,
            .nav-link:active,
            .mobile-nav-link:active {
                transform: scale(0.98);
            }
        }
        
        
        input, select, textarea {
            font-size: 16px !important;
        }
        
        
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--color-dark);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--color-yellow);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--color-yellow-dark);
        }

        
        .admin-badge {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 20px;
            margin-left: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        </style>
</head>
<body>
    
    <header class="header">
        <div class="header-container">
            <a href="{{ route('home') }}" class="logo-container">
                <img src="{{ asset('storage/ReGymSymbol.png') }}" alt="ReGYM Logo" class="logo-img">
                <div class="logo-text">
                    <span>Re</span>GYM
                </div>
            </a>
            
            <nav class="nav">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Главная</a>
                <a href="{{ route('prices') }}" class="nav-link {{ request()->routeIs('prices') ? 'active' : '' }}">Цены</a>
                <a href="{{ route('trainers') }}" class="nav-link {{ request()->routeIs('trainers') ? 'active' : '' }}">Тренеры</a>
                <a href="{{ route('gym.layout') }}" class="nav-link {{ request()->routeIs('gym.layout') ? 'active' : '' }}">Планировка</a>
                <a href="#contacts" class="nav-link">Контакты</a>
            </nav>
            
            <div class="header-contacts">
                <a href="tel:{{ $gymSettings['phone'] ?? '+79088390808' }}" class="phone">
                    <i class="fas fa-phone-alt"></i>
                    <span>{{ $gymSettings['phone'] ?? '+7 (908) 839-08-08' }}</span>
                </a>
                
                <div class="social-links">
                    <a href="https://t.me/regum_kurgan" class="social-link" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-telegram"></i>
                    </a>
                    <a href="https://vk.com/sport_regym" class="social-link" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-vk"></i>
                    </a>
                </div>
                
                @auth
                    <div class="user-profile">
                        <a href="{{ Auth::user()->is_admin ? route('admin.dashboard') : route('user.dashboard') }}" class="user-profile-link" title="{{ Auth::user()->is_admin ? 'Админ-панель' : 'Личный кабинет' }}">
                            <i class="fas fa-user-circle"></i>
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            @if(Auth::user()->is_admin)
                                <span class="admin-badge">Admin</span>
                            @endif
                        </a>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="logout-btn" title="Выйти">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="auth-buttons">
                        <a href="{{ route('login') }}" class="auth-link login-link" title="Войти">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Вход</span>
                        </a>
                        <a href="{{ route('register') }}" class="auth-link register-link" title="Регистрация">
                            <i class="fas fa-user-plus"></i>
                            <span>Регистрация</span>
                        </a>
                    </div>
                @endauth
                
                <button class="mobile-menu-btn" aria-label="Меню">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>

    
    <div class="mobile-menu">
        <nav class="mobile-nav">
            <a href="{{ route('home') }}" class="mobile-nav-link">Главная</a>
            <a href="{{ route('prices') }}" class="mobile-nav-link">Цены</a>
            <a href="{{ route('trainers') }}" class="mobile-nav-link">Тренеры</a>
            <a href="{{ route('gym.layout') }}" class="mobile-nav-link">Планировка зала</a>
            <a href="#contacts" class="mobile-nav-link">Контакты</a>
        </nav>
        
        <div class="mobile-contacts">
            <a href="tel:{{ $gymSettings['phone'] ?? '+79088390808' }}" class="mobile-phone">
                <i class="fas fa-phone-alt"></i>
                {{ $gymSettings['phone'] ?? '+7 (908) 839-08-08' }}
            </a>
            
            <div class="mobile-social-links">
                <a href="https://t.me/regum_kurgan" class="mobile-social-link" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-telegram"></i> Telegram
                </a>
                <a href="https://vk.com/sport_regym" class="mobile-social-link" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-vk"></i> VK
                </a>
            </div>
            
            @auth
                <div class="mobile-auth">
                    <a href="{{ Auth::user()->is_admin ? route('admin.dashboard') : route('user.dashboard') }}" class="mobile-auth-link">
                        <i class="fas {{ Auth::user()->is_admin ? 'fa-shield-alt' : 'fa-user-circle' }}"></i>
                        {{ Auth::user()->is_admin ? 'Админ-панель' : 'Личный кабинет' }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="mobile-logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Выйти
                        </button>
                    </form>
                </div>
            @else
                <div class="mobile-auth">
                    <a href="{{ route('login') }}" class="mobile-auth-link">
                        <i class="fas fa-sign-in-alt"></i> Вход
                    </a>
                    <a href="{{ route('register') }}" class="mobile-auth-link">
                        <i class="fas fa-user-plus"></i> Регистрация
                    </a>
                </div>
            @endauth
        </div>
    </div>
        
    
    <main>
        @yield('content')
    </main>
    
    
    <footer class="footer" id="contacts">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <a href="{{ route('home') }}" class="footer-logo">
                        <img src="{{ asset('storage/ReGymSymbol.png') }}" alt="ReGYM Logo" class="footer-logo-img">
                        <div class="footer-logo-text">
                            <span>Re</span>GYM
                        </div>
                    </a>
                    
                    <div class="footer-info">
                        <div class="footer-info-item">
                            <span class="footer-info-label">📍 Адрес:</span>
                            <span class="footer-info-value">{{ $gymSettings['address'] ?? '3-й микрорайон, д. 6Б, Курган' }}</span>
                        </div>
                        
                        <div class="footer-info-item">
                            <span class="footer-info-label">📞 Телефон:</span>
                            <a href="tel:{{ $gymSettings['phone'] ?? '+79088390808' }}" class="footer-info-value">
                                {{ $gymSettings['phone'] ?? '+7 (908) 839-08-08' }}
                            </a>
                        </div>
                        
                        <div class="footer-info-item">
                            <span class="footer-info-label">⏰ Время работы:</span>
                            <span class="footer-info-value">Пн-Пт: {{ $gymSettings['work_hours_weekdays'] ?? '7:00 - 23:00' }}</span>
                            <span class="footer-info-value">Сб-Вс: {{ $gymSettings['work_hours_weekends'] ?? '9:00 - 21:00' }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3 class="footer-title">Навигация</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right"></i> Главная</a></li>
                        <li><a href="{{ route('prices') }}"><i class="fas fa-chevron-right"></i> Цены</a></li>
                        <li><a href="{{ route('trainers') }}"><i class="fas fa-chevron-right"></i> Тренеры</a></li>
                        <li><a href="{{ route('gym.layout') }}"><i class="fas fa-chevron-right"></i> Планировка зала</a></li>
                        <li><a href="{{ route('subscription.plans') }}"><i class="fas fa-chevron-right"></i> Абонементы</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3 class="footer-title">Мы в соцсетях</h3>
                    <div class="footer-social-grid">
                        <a href="https://t.me/regum_kurgan" class="footer-social-item" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-telegram"></i>
                            <span class="footer-social-text">Telegram</span>
                        </a>
                        <a href="https://vk.com/sport_regym" class="footer-social-item" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-vk"></i>
                            <span class="footer-social-text">VKontakte</span>
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $gymSettings['phone'] ?? '79088390808') }}" class="footer-social-item" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-whatsapp"></i>
                            <span class="footer-social-text">WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>© {{ date('Y') }} Спортивный клуб "ReGYM" в Кургане. ИП Паклин О.Н. ИНН: 450131353450</p>
                <p style="margin-top: 10px;">
                    <a href="#">Политика конфиденциальности</a> | 
                    <a href="#">Правила возврата</a> |
                    <a href="#">Пользовательское соглашение</a>
                </p>
            </div>
        </div>
    </footer>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            const mobileMenu = document.querySelector('.mobile-menu');
            const body = document.body;
            
            function toggleMobileMenu() {
                mobileMenuBtn.classList.toggle('active');
                mobileMenu.classList.toggle('active');
                body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
            }
            
            function closeMobileMenu() {
                mobileMenuBtn.classList.remove('active');
                mobileMenu.classList.remove('active');
                body.style.overflow = '';
            }
            
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', toggleMobileMenu);
            }
            
            
            document.querySelectorAll('.mobile-nav-link').forEach(link => {
                link.addEventListener('click', closeMobileMenu);
            });
            
            
            document.addEventListener('click', (e) => {
                if (mobileMenu && mobileMenu.classList.contains('active') && 
                    !mobileMenu.contains(e.target) && 
                    mobileMenuBtn && !mobileMenuBtn.contains(e.target)) {
                    closeMobileMenu();
                }
            });
            
            
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && mobileMenu && mobileMenu.classList.contains('active')) {
                    closeMobileMenu();
                }
            });
            
            
            document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (!targetId || targetId === '#') return;
                    
                    const target = document.querySelector(targetId);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        closeMobileMenu();
                    }
                });
            });
            
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
            
            
            const header = document.querySelector('.header');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
            
            
            const phoneInput = document.querySelector('input[name="phone"]');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    let value = this.value.replace(/\D/g, '');
                    if (value.length > 0) {
                        if (!value.startsWith('7') && !value.startsWith('8')) {
                            value = '7' + value;
                        }
                        if (value.startsWith('8')) {
                            value = '7' + value.substring(1);
                        }
                        
                        let formatted = '+7 (';
                        if (value.length > 1) {
                            formatted += value.substring(1, 4);
                        }
                        if (value.length >= 4) {
                            formatted += ') ' + value.substring(4, 7);
                        }
                        if (value.length >= 7) {
                            formatted += '-' + value.substring(7, 9);
                        }
                        if (value.length >= 9) {
                            formatted += '-' + value.substring(9, 11);
                        }
                        
                        this.value = formatted;
                    } else {
                        this.value = '';
                    }
                });
            }
            
            
            const yearSpan = document.getElementById('currentYear');
            if (yearSpan) {
                yearSpan.textContent = new Date().getFullYear();
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>