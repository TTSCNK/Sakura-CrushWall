
# 🌸 樱花表白墙 - 液态毛玻璃设计语言

> 一款采用全新液态毛玻璃设计语言的现代化表白墙应用，为你的校园生活增添一抹浪漫气息 ✨

---

## 📊 项目统计

| 指标 | 数据 |
|------|------|
| ⭐ Star | [![GitHub Stars](https://img.shields.io/github/stars/TTSCNK/Sakura-CrushWall?style=flat-square)](https://github.com/TTSCNK/Sakura-CrushWall) |
| 🍴 Fork | [![GitHub Forks](https://img.shields.io/github/forks/TTSCNK/Sakura-CrushWall?style=flat-square)](https://github.com/TTSCNK/Sakura-CrushWall) |
| 📝 Issues | [![GitHub Issues](https://img.shields.io/github/issues/TTSCNK/Sakura-CrushWall?style=flat-square)](https://github.com/TTSCNK/Sakura-CrushWall/issues) |
| 📅 最后更新 | [![GitHub Last Commit](https://img.shields.io/github/last-commit/TTSCNK/Sakura-CrushWall?style=flat-square)](https://github.com/TTSCNK/Sakura-CrushWall/commits/main) |
| 📄 许可证 | [![GitHub License](https://img.shields.io/github/license/TTSCNK/Sakura-CrushWall?style=flat-square)](https://github.com/TTSCNK/Sakura-CrushWall/blob/main/LICENSE) |
| 👤 作者 | [![GitHub Profile](https://img.shields.io/badge/GitHub-TTSCNK-blue?style=flat-square)](https://github.com/TTSCNK) |

---

## ✨ 液态毛玻璃设计语言

### 🌊 设计理念

我们采用了全新的 **液态毛玻璃设计语言**，为用户带来沉浸式的视觉体验：

- **💎 毛玻璃效果** - 半透明背景配合模糊滤镜，营造层次感
- **🌸 樱花主题** - 粉白渐变配色，传递浪漫氛围
- **💫 流体动画** - 柔和的过渡效果，平滑的交互体验
- **🎨 现代美学** - 简洁的界面设计，注重留白与呼吸感

### 🎯 设计特点

| 特性 | 描述 |
|------|------|
| 🌙 **夜间模式** | 支持昼夜切换，护眼更舒适 |
| 📱 **响应式布局** | 完美适配各种屏幕尺寸 |
| ✨ **粒子特效** | 樱花飘落动画，增添浪漫气息 |
| 🔒 **安全防护** | 完善的安全机制，保护用户隐私 |

---

## 🚀 快速开始

### 📋 环境要求

- **PHP**: 5.6.16+
- **MySQL**: 5.6.50+
- **Web Server**: Apache / Nginx

### 🛠️ 安装步骤

1. **克隆项目**
   ```bash
   git clone https://github.com/TTSCNK/Sakura-CrushWall.git
   cd Sakura-CrushWall
   ```

2. **导入数据库**
   ```bash
   mysql -u username -p database_name < sakura.sql
   ```

3. **配置数据库连接**
   ```php
   // 修改 /sakura/mysql.php
   $host = 'localhost';
   $user = 'your_username';
   $pass = 'your_password';
   $dbname = 'your_database';
   ```

4. **启动服务**
   ```bash
   # Apache/Nginx 部署
   # 或使用 PHP 内置服务器（仅开发环境）
   php -S localhost:8080
   ```

---

## 🔐 后台管理

| 项目 | 信息 |
|------|------|
| 🔑 默认账号 | `admin` |
| 🔑 默认密码 | `123456` |
| 🌐 后台地址 | `/admin/index.html` |

> ⚠️ **安全提示**: 首次登录后请立即修改默认密码！

---

## 🗂️ 项目结构

```
sakura-wall/
├── 🌸 admin/          # 后台管理系统
├── 🔧 api/            # 后端API接口
├── 🎨 css/            # 样式文件
├── 🖼️ img/            # 图片资源
├── 📜 js/             # JavaScript文件
├── 🗃️ sakura/         # 数据库配置
├── 📄 index.php       # 入口文件
├── 📊 sakura.sql      # 数据库脚本
└── 🔑 create_tables.php # 建表脚本
```

---


## 🤝 贡献指南

欢迎提交 Issue 和 Pull Request！

### 📋 贡献步骤

1. Fork 本仓库
2. 创建功能分支 `git checkout -b feature/xxx`
3. 提交更改 `git commit -m 'feat: xxx'`
4. 推送到分支 `git push origin feature/xxx`
5. 创建 Pull Request

---

## 📝 版本日志

### v2025.12.5 🌸
- ✨ 引入液态毛玻璃设计语言
- 🎨 优化界面视觉效果
- 🔧 修复已知 Bug
- 📱 增强移动端适配

---

## 📧 联系方式

| 渠道 | 信息 |
|------|------|
| 👨‍💻 原作者 | 樱振宇 |
| 👨‍💻 毛玻璃版 | TTS |
| 📧 个人主页 | https://www.ttscn.top |

---

## 📄 许可证

本项目采用 MIT 许可证 - 查看 [LICENSE](LICENSE) 文件了解详情

---

> 🌸 **表白墙想发展好点，最关键的就是要长久运营！**
> 
> 如果您觉得这个项目不错，请给个 ⭐ Star 支持一下！
