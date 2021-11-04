
#FROM nginx:latest
#COPY dist/  /usr/share/nginx/vueproject/
#COPY ./vue.conf /etc/nginx/conf.d/vue.conf
# pull the Node.js Docker image

FROM node:lts-alpine

# устанавливаем простой HTTP-сервер для статики
RUN npm install -g http-server

# делаем каталог 'app' текущим рабочим каталогом
WORKDIR /app

# копируем оба 'package.json' и 'package-lock.json' (если есть)
COPY package*.json ./

# устанавливаем зависимости проекта
RUN npm install

# копируем файлы и каталоги проекта в текущий рабочий каталог (т.е. в каталог 'app')
COPY . .

# собираем приложение для production с минификацией
RUN npm run build

EXPOSE 8080

CMD ["npm","run","serve"]






