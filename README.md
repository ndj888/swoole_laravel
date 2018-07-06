# swoole_laravel

## 特点
laravel +swoole 架构
1. 适配laravel和swoole结合
2. 加入执行器注解解析
3. 加入swoole模式和常规php-fpm开发模式切换 前者用于生产环境 后者用于开发环境
4. 加入生产模式laravel orm 切换适配使用mysql长连接
5. 加入生产环境启动脚本 自动加载优化 缓存优化
6. 加入适配微服务的抽象内部api调用 先用http实现 后切换为socket
7. 负载均衡通过nginx配置实现，每台服务器部署完整得openapi +其他服务