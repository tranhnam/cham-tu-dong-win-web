 uses crt;
 var a,b:ansistring;
     x,y:array[0..1000] of integer;
     d:integer;
     f:text;
 Procedure Nhap;
 var i:integer;
 begin
    assign(f,'thuocla.inp');
    reset(f);
        readln(f);
        readln(f,a);
        d:=0;
        for i:= 1 to length(a) do
           if a[i]='1' then inc(d);
    close(f);
 end;
 Function Timvt(s:ansistring):integer;
 var i,min,vt,n:integer;
 begin
    n:=length(s);x[0]:=0;y[0]:=0;
    if s[1]=a[1] then x[1]:=0 else x[1]:=1;
    if s[n]=a[n+1] then y[n]:=0 else y[n]:=1;
    for i:= 2 to n do
       begin
          if s[i]=a[i] then x[i]:=x[i-1]
          else x[i]:=x[i-1]+1;
          if s[n-i+1]=a[n-i+2] then y[n-i+1]:=y[n-i+2]
          else y[n-i+1]:=y[n-i+2]+1;
       end;
   min:=maxint;vt:=0;
   for i:= 1 to n do
      if min>x[i-1]+y[i]+ord(a[i]='1') then
         begin
            min:=x[i-1]+y[i]+ord(a[i]='1');
            vt:=i;
         end;
   Timvt:=vt;
 end;
 Procedure Sosanh(x,y:ansistring;var z:ansistring);
 var i,j,k,l:integer;
 begin
    k:=0;l:=0;
    for i:= 1 to length(a) do
       begin
          if x[i]<>a[i] then inc(k);
          if y[i]<>a[i] then inc(l);
       end;
    if k<l then z:=x else z:=y;
 end;
 Procedure Xuat(s:ansistring);
 var x,y:array[1..1000] of byte;
     i,k,l:integer;
 begin
    k:=0;l:=0;
    for i:= 1 to length(s) do
       if a[i]<>s[i] then
          if a[i]='1' then
             begin
                inc(k);
                x[k]:=i;
             end
          else
             begin
                inc(l);
                y[l]:=i;
             end;
    assign(f,'');
    rewrite(f);
       writeln(f,k);
       for i:= 1 to k do
          writeln(f,x[i],' ',y[i]);
    close(f);
 end;
 Procedure Xuli;
 var b,c,kq:ansistring;
     i,l,t:integer;
 begin
    b:='';c:='';
    for i:= 1 to d do
       begin
          b:=b+'10';
          c:=c+'01';
       end;
    l:=length(a)-length(b);
    if l<>0 then
       repeat
          dec(l);
          Insert('0',b,Timvt(b));
          Insert('0',c,Timvt(c));
       until l=0;
    Sosanh(b,c,kq);
    Xuat(kq);
 end;
 begin
    Nhap;
    Xuli;
    readln
 end.
