FROM nginx:alpine

RUN mkdir /etc/nginx/ssl

COPY ./.docker/nginx/domains.ext ./

RUN apk update && \
    apk add --no-cache openssl && \
    openssl req -x509 -nodes -new -sha256 -days 1024 \
    -newkey rsa:2048 -keyout RootCA.key -out RootCA.pem \
    -subj "/C=US/CN=Example-Root-CA" && \
    openssl x509 -outform pem -in RootCA.pem -out RootCA.crt

RUN openssl req -new -nodes -newkey rsa:2048 \
    -subj "/C=US/ST=YourState/L=YourCity/O=Example-Certificates/CN=localhost.local" \
    -keyout /etc/nginx/ssl/site.test.key \
    -out /etc/nginx/ssl/site.test.csr && \
    openssl x509 -req -sha256 -days 1024 \
    -in /etc/nginx/ssl/site.test.csr \
    -out /etc/nginx/ssl/site.test.crt \
    -CA RootCA.pem -CAkey RootCA.key -CAcreateserial -extfile domains.ext
