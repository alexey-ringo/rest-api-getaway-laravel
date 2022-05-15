# Информация о разрешениях операций

## `GET` /v1/api/permissions

Список всех разрешений операций

#### Пример ответа
```json
{
    "data": [
        {
            "id": 6,
            "name": "perm-1",
            "slug": "perm-1"
        },
        {
            "id": 9,
            "name": "auth-check",
            "slug": "auth-check"
        },
        {
            "id": 10,
            "name": "auth-register",
            "slug": "auth-register"
        },
        {
            "id": 11,
            "name": "auth-recovery",
            "slug": "auth-recovery"
        },
        {
            "id": 12,
            "name": "auth-confirm",
            "slug": "auth-confirm"
        },
        {
            "id": 13,
            "name": "auth-logout",
            "slug": "auth-logout"
        },
        {
            "id": 14,
            "name": "news-index",
            "slug": "news-index"
        }
    ]
}
```

## `POST` /v1/api/permissions

Создание нового разрешения операции

#### Параметры запроса

|Параметр     |Тип|Описание|
|-------------|---|--------|
|type|(string) `optional`|Фильтр по типу уведомления|
|unread|(int) `optional`|`1` - только прочитанные|
| page | (int) `optional`| см. [Пагинация](pagination.md) |

#### Пример ответа
```json
{
    "data": [
        {
            "id": 6,
            "name": "perm-1",
            "slug": "perm-1"
        },
        {
            "id": 9,
            "name": "auth-check",
            "slug": "auth-check"
        },
        {
            "id": 10,
            "name": "auth-register",
            "slug": "auth-register"
        },
        {
            "id": 11,
            "name": "auth-recovery",
            "slug": "auth-recovery"
        },
        {
            "id": 12,
            "name": "auth-confirm",
            "slug": "auth-confirm"
        },
        {
            "id": 13,
            "name": "auth-logout",
            "slug": "auth-logout"
        },
        {
            "id": 14,
            "name": "news-index",
            "slug": "news-index"
        }
    ]
}
```

# Уведомления

## `GET` api/v2/notifications

Вывод уведомлений

#### Параметры запроса

|Параметр     |Тип|Описание|
|-------------|---|--------|
|type|(string) `optional`|Фильтр по типу уведомления|
|unread|(int) `optional`|`1` - только прочитанные|
| page | (int) `optional`| см. [Пагинация](pagination.md) |

#### Пример ответа

```json
{
  "data": [
    {
      "id": "488791b4-fcaf-4e39-8b2b-09676598ab52",
      "text": "Пожалуйста, пройдите верификацию! После верификации вам откроется доступ к разделам Сборы на портале «Такие дела», Планирование и Аналитика.",
      "type": "UserRegistered",
      "data": [],
      "read": false,
      "created_at": 1612761293
    },
    ...
  ],
  ...
}
```

## `POST` api/v2/notifications

Отметить уведомления как прочитанные

#### Параметры запроса

|Параметр     |Тип|Описание|
|-------------|---|--------|
|all|(int) `optional`|`1` - отметить все уведомления как прочитанные|
|id|(string) `optional`|UUID уведомления|

#### Пример ответа

```
void
```





















# Информация об авторизованном пользователе

## `GET` api/v2/user

Здесь позже будет информация как происходит аутентификация

#### Пример ответа
`fund`, `verification`, `cases` не доступны для координатора
```json
{
  "user": {
    "id": 122,
    "global_id": 233735,
    "email": "ps.prokofiev@gmail.com",
    "phone": null,
    "role": "user",
    "position": null,
    "name": {
      "first_name": "Pavel",
      "last_name": "Prokofiev",
      "full_name": "Pavel Prokofiev",
      "full_last": "Prokofiev Pavel"
    },
    "verified": true // не отображается у координатора
  },
  "reminders": {
    // см. "Пример ответа" в разделе "Уведомления"
  },
  "notifications": 5,
  "fund": {
    "id": 1021,
    "remote_id": null,
    "name": "TestFund999",
    "logo": "http://nginx/storage/fund_base/hrKQYXC5OksGgijokkcPP4kpqCkBvHk9mcqrKfsZ.jpg",
    "step": 7,
    "status": null
    "reg_date": "2020-05-05"
  },
  "verification": {
    "id": 1020,
    "step": 0,
    "status": "verified"
  },
  "cases": {
    "total": 2,
    "closed": 1
  }
}
```

# Уведомления

## `GET` api/v2/notifications

Вывод уведомлений

#### Параметры запроса

|Параметр     |Тип|Описание|
|-------------|---|--------|
|type|(string) `optional`|Фильтр по типу уведомления|
|unread|(int) `optional`|`1` - только прочитанные|
| page | (int) `optional`| см. [Пагинация](pagination.md) |

#### Пример ответа

```json
{
  "data": [
    {
      "id": "488791b4-fcaf-4e39-8b2b-09676598ab52",
      "text": "Пожалуйста, пройдите верификацию! После верификации вам откроется доступ к разделам Сборы на портале «Такие дела», Планирование и Аналитика.",
      "type": "UserRegistered",
      "data": [],
      "read": false,
      "created_at": 1612761293
    },
    ...
  ],
  ...
}
```

## `POST` api/v2/notifications

Отметить уведомления как прочитанные

#### Параметры запроса

|Параметр     |Тип|Описание|
|-------------|---|--------|
|all|(int) `optional`|`1` - отметить все уведомления как прочитанные|
|id|(string) `optional`|UUID уведомления|

#### Пример ответа

```
void
```
