
# BD_Project - проект по базам данных
CRUD-приложение на чистом PHP для взаимодействия с большой базой данных MySQL.

## Особенности проекта
- База данных состоит из 11 таблиц по теме "Курсы по подготовке к ЕГЭ"
- Возможность регистрации и авторизации, присутствие сессий
- Разделение ролей на создатиля курса и кандидата в учителя
- Отличие интерфейса у разных ролей
- Фильтрация данных
- Возможность быстро развернуть с помощию docker compose

## Самостоятельная сборка и запуск
Вы можете клонировать репозиторий и в папке проекта прописать "docker compose up". Приложение будет локально развернуто и доступно по адрессу "http://localhost:8000/"
## Скриншоты 
<p float="left">
    <img src="/media/auth.png" width="800" />
    <div> Внешний вид странички входа в аккаунт</div>
</p>
<p float="left">
    <img src="/media/reg.png" width="800" /> 
    <div>Внешний вид странички регистрации</div>
</p>
<p float="left">
    <img src="/media/main_admin.png" width="800" />
    <div>Внешний вид главной странички у администратора</div> 
</p>
<p float="left">
    <img src="/media/main_teacher.png" width="800" /> 
    <div>Внешний вид главной странички у учителя</div>
</p>
<p float="left">
    <img src="/media/table1.png" width="800" />
    <div>Внешний вид странички «Создатель курса» у администратора</div>
</p>
<p float="left">
    <img src="/media/table2.png" width="800" /> 
    <div>Внешний вид странички «Кандидат в учителя» у кандидата в учителя </div>
</p>
